<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\FeaturedController;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Other\ImportRatings;
use AppBundle\Factory\Admin\Import\Product\ImportErrorFactory;
use AppBundle\Filter\Common\Main\CategoryFilter;
use AppBundle\Form\Editor\Admin\Main\CategoryEditorType;
use AppBundle\Form\Filter\Admin\Main\CategoryFilterType;
use AppBundle\Form\Lists\CategoryListType;
use AppBundle\Form\Other\ImportRatingsType;
use AppBundle\Logic\Admin\Import\Common\CountManager;
use AppBundle\Logic\Admin\Import\Product\ImportLogic;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Common\Main\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Admin\CategoryEntryParamsManager;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Repository\Admin\Main\SegmentRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use AppBundle\Filter\Common\Base\BaseFilter;

class CategoryController extends FeaturedController {
	
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
	
	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id) {
		return $this->setFeaturedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setPreleafAction(Request $request, $id) {
		return $this->setPreleafActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function treeAction(Request $request) {
		return $this->treeActionInternal($request);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function ratingsAction(Request $request, $id) {
		return $this->ratingsActionInternal($request, $id);
	}

	public function clearRatingsAction(Request $request, $id) {
		return $this->clearRatingsActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
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
	
	protected function setPreleafActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted('ROLE_EDITOR', null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getSetPreleafRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$preleaf = $request->get('value', false);
		
		$em = $this->getDoctrine()->getManager();
		
		$entry->setPreleaf($preleaf);
		$em->persist($entry);
		$em->flush();
		
		return $this->redirectToReferer($request);
	}
	
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
	
	protected function treeActionInternal(Request $request) {
		$params = $this->createParams($this->getTreeRoute());
		$params = $this->getTreeParams($request, $params);
		
		$viewParams = $params['viewParams'];
		
		return $this->render($this->getTreeView(), $viewParams);
	}
	
	// TODO make form blocks like in AdminController
	protected function ratingsActionInternal(Request $request, $id) {
		$params = $this->createParams($this->getRatingsRoute());
		$params = $this->getRatingsParams($request, $params, $id);
		
		$rm = $this->getRouteManager();
		$rm->register($request, $params['route'], $params['routeParams']);
		
		$am = $this->getAnalyticsManager();
		$am->sendPageviewAnalytics($params['domain'], $params['route']);
		$am->sendEventAnalytics($this->getEntityName(), 'ratings', $id);
		
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		
		$importRatings = new ImportRatings();
		
		$importRatingsForm = $this->createForm(ImportRatingsType::class, $importRatings);
		$importRatingsForm->handleRequest($request);
		
		if ($importRatingsForm->isSubmitted() && $importRatingsForm->isValid()) {
			
			$doctrine = $this->getDoctrine();
			$translator = $this->get('translator');
			$errorFactory = new ImportErrorFactory($translator);
			$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils();
			
			$productManager = $this->get('app.import.persistence_manager.product');
			$productCategoryAssignmentManager = $this->get(
					'app.import.persistence_manager.product_category_assignment');
			$productValueManager = $this->get('app.import.persistence_manager.product_value');
			$productScoreManager = $this->get('app.import.persistence_manager.product_score');
			$productNoteManager = $this->get('app.import.persistence_manager.product_note');
			$brandManager = $this->get('app.import.persistence_manager.brand');
			$benchmarkFieldManager = $this->get('app.import.persistence_manager.benchmark_field');
			$categorySummaryManager = $this->get('app.import.persistence_manager.category_summary');
			
			$countManager = $this->get(CountManager::class);
			$importLogic = new ImportLogic($doctrine, $errorFactory, $benchmarkFieldDataBaseUtils, 
					$productManager, $productCategoryAssignmentManager, $productValueManager, 
					$productScoreManager, $productNoteManager, $brandManager, $benchmarkFieldManager, 
					$categorySummaryManager, $countManager);
			
			$result = $importLogic->importRatings($importRatings, $entry);
			$errors = $result['errors'];
			if (count($errors) > 0) {
				foreach ($errors as $error) {
					$this->addFlash('error', $error);
				}
			} else {
				$translator = $this->get('translator');
				
				$lines = $result['lines'];
				
				$msg = $translator->trans('success.category.ratingsImported');
				$msg = nl2br($msg);
				
				$msg = str_replace('%lines%', $lines, $msg);
				
				$msg = $this->replaceCounts($msg, $result, 'products');
				$msg = $this->replaceCounts($msg, $result, 'productValues');
				$msg = $this->replaceCounts($msg, $result, 'productScores');
				$msg = $this->replaceCounts($msg, $result, 'productNotes');
				
				$msg = $this->replaceCounts($msg, $result, 'assignments');
				
				$msg = $this->replaceCounts($msg, $result, 'brands');
				$msg = $this->replaceCounts($msg, $result, 'benchmarkFields');
				
				$this->addFlash('success', $msg);
			}
		}
		
		$viewParams['importRatingsForm'] = $importRatingsForm->createView();
		
		return $this->render($this->getRatingsView(), $viewParams);
	}

	protected function replaceCounts($message, array $result, $key) {
		$message = $this->replaceCount($message, $result, $key, 'duplicated');
		$message = $this->replaceCount($message, $result, $key, 'created');
		$message = $this->replaceCount($message, $result, $key, 'updated');
		$message = $this->replaceCount($message, $result, $key, 'all');
		
		return $message;
	}

	protected function replaceCount($message, array $result, $key, $countKey) {
		return str_replace('%' . $countKey . '_' . $key . '%', $result[$key . 'Counts'][$countKey], $message);
	}

	protected function clearRatingsActionInternal(Request $request, $id) {
		$this->denyAccessUnlessGranted('ROLE_RATING_EDITOR', null, 'Unable to access this page!');
		
		$params = $this->createParams($this->getRatingsRoute());
		$params = $this->getEditParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$result = $this->clearRatings($entry);
		$errors = $result['errors'];
		if (count($errors) > 0) {
			foreach ($errors as $error) {
				$this->addFlash('error', $error);
			}
		} else {
			$translator = $this->get('translator');
			
			$count = $result['count'];
			
			$msg = $translator->trans('success.category.ratingsCleared');
			$msg = nl2br($msg);
			
			$msg = str_replace('%count%', $count, $msg);
			$this->addFlash('success', $msg);
		}
		
		return $this->redirectToReferer($request);
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.main.category');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.main.category');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.subname_list_items_provider');
	}

	/**
	 *
	 * @param Category $entry        	
	 */
	protected function clearRatings($entry) {
		$result = array();
		$errors = array();
		
		$count = 0;
		
		$em = $this->getDoctrine()->getManager();
		$em->getConnection()->beginTransaction();
		
		try {
			foreach ($entry->getProductCategoryAssignments() as $productCategoryAssignment) {
				$em->remove($productCategoryAssignment);
				$count ++;
			}
			$em->flush();
			
			foreach ($entry->getBrandCategoryAssignments() as $brandCategoryAssignment) {
				$em->remove($brandCategoryAssignment);
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
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$categoryRepository = $this->get(CategoryRepository::class);
		$segmentRepository = $this->get(SegmentRepository::class);
		
		return new CategoryEntryParamsManager($em, $fm, $categoryRepository, $segmentRepository);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CategoryManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new CategoryFilter());
	}
	
	// ---------------------------------------------------------------------------
	// Params
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @param array $params        	
	 * @return array
	 */
	protected function getTreeParams(Request $request, array $params) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getTreeParams($request, $params);
		
		return $params;
	}

	protected function getRatingsParams(Request $request, array $params, $id) {
		$params = $this->getParams($request, $params);
		
		$em = $this->getEntryParamsManager();
		$params = $em->getRatingsParams($request, $params, $id);
		
		return $params;
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEntityType() {
		return Category::class;
	}
	
	// ---------------------------------------------------------------------------
	// Forms
	// ---------------------------------------------------------------------------
	protected function getEditorFormType() {
		return CategoryEditorType::class;
	}

	protected function getFilterFormType() {
		return CategoryFilterType::class;
	}

	protected function getListFormType() {
		return CategoryListType::class;
	}
	
	// ---------------------------------------------------------------------------
	// Views
	// ---------------------------------------------------------------------------
	protected function getTreeView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/tree.html.twig';
	}

	protected function getRatingsView() {
		return $this->getDomain() . '/' . $this->getEntityName() . '/ratings.html.twig';
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getTreeRoute() {
		return $this->getIndexRoute() . '_tree';
	}

	protected function getRatingsRoute() {
		return $this->getIndexRoute() . '_ratings';
	}
	
	protected function getSetBenchmarkRoute() {
		return $this->getIndexRoute() . '_set_bm_published';
	}
	
	protected function getSetPreleafRoute() {
		return $this->getIndexRoute() . '_set_preleaf';
	}
}