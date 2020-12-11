<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\BaseController;
use AppBundle\Controller\Benchmark\Base\BenchmarkAdminController;
use AppBundle\Entity\Main\Product;
use AppBundle\Factory\Common\BenchmarkField\SimpleBenchmarkFieldFactory;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Form\Editor\Benchmark\ProductEditorType;
use AppBundle\Form\Filter\Benchmark\CategoryFilterType;
use AppBundle\Form\Filter\Benchmark\CustomProductFilterType;
use AppBundle\Form\Filter\Benchmark\SubcategoryFilterType;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\CustomProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\CustomProductEntryParamsManager;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Utils\Entity\BenchmarkFieldUtils;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;
use Symfony\Component\HttpFoundation\Request;

class CustomProductController extends BenchmarkAdminController {
	
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
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$translator = $this->get('translator');
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($translator);
		
		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils();
		$benchmarkFieldUtils = new BenchmarkFieldUtils($benchmarkFieldDataBaseUtils);
		$benchmarkFieldFactory = new SimpleBenchmarkFieldFactory($benchmarkFieldUtils);
		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializer($benchmarkFieldFactory);
		
		$categoryRepository = $this->get(CategoryRepository::class);
		
		$productFilter = new ProductFilter($benchmarkFieldsProvider, $benchmarkFieldsInitializer, 
				$categoryRepository);
		
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
		$response = parent::initNewForms($request, $params);
		if ($response)
			return $response;
		
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
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
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
}