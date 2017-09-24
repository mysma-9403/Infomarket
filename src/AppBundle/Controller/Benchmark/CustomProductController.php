<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\BaseController;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Main\ProductNote;
use AppBundle\Factory\Common\BenchmarkField\SimpleBenchmarkFieldFactory;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Form\Editor\Benchmark\ProductEditorType;
use AppBundle\Form\Filter\Benchmark\CategoryFilterType;
use AppBundle\Form\Filter\Benchmark\CustomProductFilterType;
use AppBundle\Form\Filter\Benchmark\SubcategoryFilterType;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializerImpl;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\CustomProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\CustomProductEntryParamsManager;
use AppBundle\Repository\Common\BenchmarkFieldMetadataRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Symfony\Component\HttpFoundation\Request;

class CustomProductController extends BaseController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}

	public function editAction(Request $request, $id) {
		return $this->editActionInternal($request, $id);
	}

	public function copyAction(Request $request, $id) {
		return $this->copyActionInternal($request, $id);
	}

	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	public function deleteAction(Request $request, $id) {
		return $this->deleteActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalContextParamsManager($doctrine, $lastRouteParams) {
		return $this->get(ContextParamsManager::class);
	}

	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$manager = $doctrine->getManager();
		$benchmarkFieldMetadataRepository = new BenchmarkFieldMetadataRepository($manager, 
				$manager->getClassMetadata(BenchmarkField::class));
		$translator = $this->get('translator');
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($benchmarkFieldMetadataRepository, $translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils();
		$benchmarkFieldFactory = new SimpleBenchmarkFieldFactory($benchmarkFieldDataBaseUtils);
		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializerImpl($benchmarkFieldFactory);
		
		$productFilter = new ProductFilter($benchmarkFieldsProvider, $benchmarkFieldsInitializer);
		
		return new CustomProductEntryParamsManager($em, $fm, $productFilter);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CustomProductManager::class);
	}

	protected function getFilterManager($doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$filter = new CustomProductFilter();
		$filter->setContextUser($user);
		
		return new FilterManager($filter);
	}
	
	// ---------------------------------------------------------------------------
	// Forms
	// ---------------------------------------------------------------------------
	protected function initNewForms(Request $request, array &$params) {
		$response = $this->initUpdateForm($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initCategoryForm($request, $params);
		if ($response)
			return $response;
		
		$response = $this->initSubcategoryForm($request, $params);
		if ($response)
			return $response;
		
		return null;
	}

	protected function initUpdateForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$optionsProvider = $this->getEditorFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm($this->getEditorFormType(), $entry, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$this->saveEntry($request, $entry, $params);
			
			$this->flashCreatedMessage();
			
			if ($form->get('save')->isClicked()) {
				return $this->redirectToRoute($this->getEditRoute(), array('id' => $entry->getId()));
			}
		}
		
		$viewParams['form'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initCategoryForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		
		$filter = $viewParams['categoryFilter'];
		
		$optionsProvider = $this->getCategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(CategoryFilterType::class, $filter, $options);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getNewRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['categoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}

	protected function initSubcategoryForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		
		$filter = $viewParams['subcategoryFilter'];
		
		$optionsProvider = $this->getSubcategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(SubcategoryFilterType::class, $filter, $options);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getNewRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['subcategoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.benchmark.product');
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Controller\Admin\Base\BaseController::getEditorFormOptionsProvider()
	 */
	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.benchmark.product');
	}

	/**
	 *
	 * @var FormOptionsProvider
	 */
	protected function getCategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_category');
	}

	/**
	 *
	 * @var FormOptionsProvider
	 */
	protected function getSubcategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_subcategory');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}

	protected function prepareEntry($request, &$entry, $params) {
		/** @var Product $entry */
		$entry->setCustom(true);
		
		return $entry;
	}

	protected function saveMore($request, $entry, $params) {
		parent::saveMore($request, $entry, $params);
		
		/** @var Product $entry */
		if (count($entry->getProductCategoryAssignments()) == 0) {
			$contextParams = $params['contextParams'];
			$subcategory = $contextParams['subcategory'];
			
			$repository = $this->getDoctrine()->getRepository(Category::class);
			$category = $repository->find($subcategory);
			
			$assignment = new ProductCategoryAssignment();
			$assignment->setProduct($entry);
			$assignment->setCategory($category);
			$assignment->setOrderNumber(99);
			$assignment->setFeatured(false);
			
			/** @var \Doctrine\Common\Persistence\ObjectManager $em */
			$em = $this->getDoctrine()->getManager();
			
			$em->persist($assignment);
			$em->flush();
			
			$note = new ProductNote();
			$note->setProductCategoryAssignment($assignment);
			$note->setOveralNote(2.0); // TODO first note should be calculated here!
			$note->setUpToDate(false);
			
			$em->persist($note);
			$em->flush();
		}
	}

	protected function deleteMore($entry) {
		/** @var Product $entry */
		$em = $this->getDoctrine()->getManager();
		foreach ($entry->getProductCategoryAssignments() as $productCategoryAssignment) {
			$em->remove($productCategoryAssignment->getProductNote());
			$em->remove($productCategoryAssignment);
		}
		$em->flush();
		
		return array();
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_USER';
	}

	protected function getEditRole() {
		return $this->getShowRole();
	}

	protected function getDeleteRole() {
		return $this->getEditRole();
	}
	
	// ---------------------------------------------------------------------------
	// Permissions
	// ---------------------------------------------------------------------------
	protected function isAdmin() {
		return false;
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEditorFormType() {
		return ProductEditorType::class;
	}

	protected function getFilterFormType() {
		return CustomProductFilterType::class;
	}

	protected function getEntityType() {
		return Product::class;
	}

	protected function getEntityName() {
		return 'custom_' . parent::getEntityName();
	}
	
	// ---------------------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	protected function getDomain() {
		return 'benchmark';
	}
}