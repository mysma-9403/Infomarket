<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Benchmark\Base\BenchmarkStandardController;
use AppBundle\Entity\Main\Category;
use AppBundle\Factory\Common\BenchmarkField\CategoryBenchmarkFieldFactory;
use AppBundle\Filter\Benchmark\CategoryFilter;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Filter\Benchmark\CategoryFilterType;
use AppBundle\Form\Filter\Benchmark\SubcategoryFilterType;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Entity\Benchmark\CategoryManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\CategoryParamsManager;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Repository\Benchmark\SegmentRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends BenchmarkStandardController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Forms
	// ---------------------------------------------------------------------------
	protected function initShowForms(Request $request, array &$params) {
		$response = parent::initShowForms($request, $params);
		if ($response) {
			return $response;
		}
		
		$response = $this->initCategoryForm($request, $params);
		if ($response) {
			return $response;
		}
		
		$response = $this->initSubcategoryForm($request, $params);
		if ($response) {
			return $response;
		}
		
		return null;
	}
	
	// TODO same like in ProductController (except route) -> refactor
	protected function initCategoryForm(Request $request, array &$params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		// TODO should be taken from params??
		$category = $contextParams['category'];
		$filter = new CategoryFilter();
		$filter->setCategory($category);
		
		$optionsProvider = $this->getCategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(CategoryFilterType::class, $filter, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getShowRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['categoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// TODO same like in ProductController (except route) -> refactor
	protected function initSubcategoryForm(Request $request, array &$params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		// TODO should be taken from params??
		$subcategory = $contextParams['subcategory'];
		$filter = new SubcategoryFilter();
		$filter->setSubcategory($subcategory);
		
		$optionsProvider = $this->getSubcategoryFormOptionsProvider();
		$options = $optionsProvider->getFormOptions($params);
		
		$form = $this->createForm(SubcategoryFilterType::class, $filter, $options);
		
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			if ($form->get('submit')->isClicked()) {
				return $this->redirectToRoute($this->getShowRoute(), $filter->getRequestValues());
			}
		}
		
		$viewParams['subcategoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	// ---------------------------------------------------------------------------
	// Form Options
	// ---------------------------------------------------------------------------
	protected function getCategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_category');
	}

	protected function getSubcategoryFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.benchmark.product_subcategory');
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		$categoryRepository = $this->get(CategoryRepository::class);
		$productRepository = $this->get(ProductRepository::class);
		$segmentRepository = $this->get(SegmentRepository::class);
		
		// TODO services.yml!!!
		$translator = $this->get('translator');
		
		/** @var ObjectManager $manager */
		$manager = $doctrine->getManager();
		
		// TODO make service
		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($translator);
		$benchmarkFieldFactory = $this->get(CategoryBenchmarkFieldFactory::class);
		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializer($benchmarkFieldFactory);
		
		$tokenStorage = $this->get('security.token_storage');
		
		return new CategoryParamsManager($em, $fm, $categoryRepository, $productRepository, $segmentRepository, 
				$benchmarkFieldsProvider, $benchmarkFieldsInitializer, $tokenStorage);
	}

	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(CategoryManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new CategoryFilter());
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getFilterFormType() {
		return CategoryFilterType::class;
	}

	protected function getEntityType() {
		return Category::class;
	}
}