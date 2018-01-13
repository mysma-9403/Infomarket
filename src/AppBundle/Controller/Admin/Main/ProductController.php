<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\ImageController;
use AppBundle\Entity\Main\Product;
use AppBundle\Factory\Common\BenchmarkField\SimpleBenchmarkFieldFactory;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Filter\Common\Main\ProductFilter;
use AppBundle\Form\Editor\Admin\Main\ProductEditorType;
use AppBundle\Form\Editor\Admin\Other\ProductValueEditorType;
use AppBundle\Form\Filter\Admin\Main\ProductFilterType;
use AppBundle\Form\Filter\Admin\Other\CategoryFilterType;
use AppBundle\Form\Lists\ProductListType;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Decorator\Base\ItemDecorator;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\Main\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\ProductEntryParamsManager;
use AppBundle\Manager\Transaction\Base\TransactionManager;
use AppBundle\Misc\FormOptions\FormOptionsProvider;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Utils\Entity\BenchmarkFieldUtils;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use AppBundle\Utils\StringUtils;
use AppBundle\Validator\Base\BaseValidator;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends ImageController {

	/**
	 *
	 * @var TransactionManager
	 */
	protected $productValueTransactionManager;

	public function __construct(TransactionManager $transactionManager, ItemDecorator $decorator, 
			BaseValidator $validator, TransactionManager $productValueTransactionManager) {
		parent::__construct($transactionManager, $decorator, $validator);
		
		$this->productValueTransactionManager = $productValueTransactionManager;
	}
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id) {
		return $this->copyActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id) {
		return $this->editActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id) {
		return $this->deleteActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id) {
		return $this->setIMPublishedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id) {
		return $this->setIPPublishedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setBMPublishedAction(Request $request, $id) {
		return $this->setBMPublishedActionInternal($request, $id);
	}

	public function deleteUnusedAction(Request $request) {
		return $this->deleteUnusedActionInternal($request);
	}

	public function getTopProductsAction(Request $request) {
		return $this->getTopProductsActionInternal($request);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function setBMPublishedActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetBenchmarkRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$benchmark = $request->get('value', false);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setBenchmark($benchmark);
		$em->persist($entry);
		$em->flush();
		
		return $this->redirectToReferer($request);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param BaseFormType $form        	
	 */
	protected function listFormActionInternal(Request $request, Form $form, BaseFilter $filter, array $listItems, 
			array $params) {
		if ($form->get('bmPublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'benchmark', 1);
		}
		
		if ($form->get('bmUnpublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'benchmark', 0);
		}
		
		return parent::listFormActionInternal($request, $form, $filter, $listItems, $params);
	}

	protected function getTopProductsActionInternal(Request $request) {
		$response = new StreamedResponse();
		$response->setCallback(
				function () {
					$handle = fopen('php://output', 'w+');
					
					$connection = $this->get('database_connection');
					
					$results = $connection->fetchAll(
							"SELECT p.name AS productName, b.name AS brandName FROM products p JOIN brands b ON b.id = p.brand_id JOIN product_category_assignments pca ON pca.product_id = p.id WHERE pca.featured = true");
					
					if (count($results) > 0) {
						foreach ($results as $row) {
							$productName = $row['productName'];
							$brandName = StringUtils::getCleanName($row['brandName']);
							$path = '/uploads/products/top-produkt/' . substr($brandName, 0, 1) . '/' .
									 $brandName;
							
							$fields = array($productName, $path);
							fputs($handle, implode($fields, ';') . "\n");
						}
					} else {
						fputcsv($handle, array(''), ';');
					}
					
					fclose($handle);
				});
		
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/csv; charset=utf-8');
		$response->headers->set('Content-Disposition', 'attachment; filename="top-produkt.csv"');
		
		return $response;
	}

	protected function deleteUnusedActionInternal(Request $request) {
		$this->denyAccessUnlessGranted('ROLE_RATING_EDITOR', null, 'Unable to access this page!');
		
		$result = $this->deleteUnused();
		$errors = $result['errors'];
		if (count($errors) > 0) {
			foreach ($errors as $error) {
				$this->addFlash('error', $error);
			}
		} else {
			$translator = $this->get('translator');
			
			$count = $result['count'];
			
			$msg = $translator->trans('success.product.unusedRemoved');
			$msg = nl2br($msg);
			
			$msg = str_replace('%count%', $count, $msg);
			$this->addFlash('success', $msg);
		}
		
		return $this->redirectToReferer($request);
	}
	
	// ---------------------------------------------------------------------------
	// Forms
	// ---------------------------------------------------------------------------
	protected function initShowForms(Request $request, array &$params) {
		$response = parent::initShowForms($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initCategoryForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initEditForms(Request $request, array &$params) {
		$response = $this->initEditorForm($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initProductValueEditorForm($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initCategoryForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initEditorForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$optionsProvider = $this->getEditorFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm($this->getEditorFormType(), $entry, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$this->saveItem($request, $entry, $params);
			
			$this->flashCreatedMessage();
			
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getEditRoute(), array('id' => $entry->getId()));
			}
		}
		
		$viewParams['form'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initProductValueEditorForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		$productValue = $viewParams['productValue'];
		
		$optionsProvider = $this->getProductValueEditorFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(ProductValueEditorType::class, $productValue, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$this->saveProductValue($request, $productValue, $params);
			
			$this->flashCreatedMessage();
			
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getEditRoute(), array('id' => $entry->getId()));
			}
		}
		
		$viewParams['productValueForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initCategoryForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$categoryFilter = $viewParams['categoryFilter'];
		$entry = $viewParams['entry'];
		
		$optionsProvider = $this->getCategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(CategoryFilterType::class, $categoryFilter, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				$params = $categoryFilter->getRequestValues();
				$params['id'] = $entry->getId();
				
				$lastRoute = $this->getRouteManager()->getLastRoute($request);
				$route = $lastRoute['route'];
				$size = strlen($route);
				$ending = substr($route, $size - 5, 5);
				
				if ($ending == '_show') {
					return $this->redirectToRoute($this->getShowRoute(), $params);
				} else {
					return $this->redirectToRoute($this->getEditRoute(), $params);
				}
			}
		}
		
		$viewParams['categoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.main.product');
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Admin\Base\BaseController::getEditorFormOptionsProvider()
	 */
	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.main.product');
	}

	protected function getProductValueEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.other.productValue');
	}

	/**
	 *
	 * @var FormOptionsProvider
	 */
	protected function getCategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.other.product_category');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}
	
	// TODO needs to be checked after transaction manager was introduced
	protected function deleteUnused() {
		$result = array();
		$errors = array();
		
		$repository = $this->getDoctrine()->getRepository($this->getEntityType());
		$all = $repository->findAll();
		
		$entries = array();
		/** @var Product $entry */
		foreach ($all as $entry) {
			if (count($entry->getProductCategoryAssignments()) <= 0) {
				$entries[] = $entry;
			}
		}
		
		$count = 0;
		
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
		
		try {
			foreach ($entries as $entry) {
				$em->remove($entry);
				$count ++;
			}
			$em->flush();
			
			$em->getConnection()->commit();
		} catch (Exception $ex) {
			$em->getConnection()->rollback();
			$errors[] = $ex->getMessage();
		}
		
		$result['count'] = $count;
		$result['errors'] = $errors;
		return $result;
	}

	protected function saveProductValue(Request $request, $item, array $params) {
		try {
			$this->productValueTransactionManager->saveItem($request, $item, $params);
		} catch (Exception $ex) {
			$this->addFlash('error', $ex->getMessage());
			return $this->redirectToReferer($request);
		}
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$translator = $this->get('translator');
		
		// TODO services.yml!!!
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils();
		$benchmarkFieldUtils = new BenchmarkFieldUtils($benchmarkFieldDataBaseUtils);
		$benchmarkFieldFactory = new SimpleBenchmarkFieldFactory($benchmarkFieldUtils);
		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializer($benchmarkFieldFactory);
		
		$categoryRepository = $this->get(CategoryRepository::class);
		
		$productFilter = new \AppBundle\Filter\Common\Other\ProductFilter($benchmarkFieldsProvider, 
				$benchmarkFieldsInitializer, $categoryRepository);
		
		return new ProductEntryParamsManager($em, $fm, $productFilter, $categoryRepository);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(ProductManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new ProductFilter());
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return Product::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return ProductEditorType::class;
	}

	protected function getFilterFormType() {
		return ProductFilterType::class;
	}

	protected function getListFormType() {
		return ProductListType::class;
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getSetBenchmarkRoute() {
		return $this->getIndexRoute() . '_set_bm_published';
	}
}
