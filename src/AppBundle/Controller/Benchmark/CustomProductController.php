<?php

namespace AppBundle\Controller\Benchmark;

use AppBundle\Controller\Admin\Base\ImageEntityController;
use AppBundle\Entity\Product;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Manager\Entity\Benchmark\ProductManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\Benchmark\ContextParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Benchmark\CustomProductEditorType;
use AppBundle\Form\Filter\Benchmark\CustomProductFilterType;
use AppBundle\Repository\Benchmark\CustomProductRepository;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Utils\StringUtils;
use AppBundle\Form\Benchmark\CategoryFilterType;
use AppBundle\Form\Benchmark\SubcategoryFilterType;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Params\EntryParams\Benchmark\CustomProductEntryParamsManager;
use AppBundle\Entity\ProductCategoryAssignment;

class CustomProductController extends ImageEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
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
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getInternalContextParamsManager($doctrine, $lastRouteParams) {
		$tokenStorage = $this->get('security.token_storage');
		return new ContextParamsManager($doctrine, $lastRouteParams, $tokenStorage);
	}
	
	protected function getInternalEntryParamsManager(EntityManager $em, FilterManager $fm, $doctrine) {
		return new CustomProductEntryParamsManager($em, $fm, $doctrine);
	}
	
	protected function getEntityManager($doctrine, $paginator) {
		return new ProductManager($doctrine, $paginator, $this->getEntityRepository());
	}
	
	protected function getFilterManager($doctrine) {
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		
		$filter = new CustomProductFilter();
		$filter->setContextUser($user);
		
		return new FilterManager($filter);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function initNewForms(Request $request, array &$params) {
		$response = $this->initUpdateForm($request, $params);
		if($response) return $response;
		
		$response = $this->initCategoryForm($request, $params);
		if($response) return $response;
		
		$response = $this->initSubcategoryForm($request, $params);
		if($response) return $response;
		
		return null;
	}
	
	protected function initUpdateForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$productFilter = $viewParams['productFilter'];
	
		$form = $this->createForm($this->getEditorFormType(), $entry, ['filter' => $productFilter]);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			$this->saveEntry($entry, $params);
	
			$translator = $this->get('translator');
			$message = $translator->trans('success.created');
			$message = str_replace('%type%', '<b>' . StringUtils::getClassName($this->getEntityType()) . '</b>', $message);
			$this->addFlash('success', $message);
	
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
		$categoryFilter = $viewParams['categoryFilter'];
	
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		$form = $this->createForm(CategoryFilterType::class, $categoryFilter, ['user' => $user]);
		
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			if ($form->get('submit')->isClicked()) {
				$params = $categoryFilter->getRequestValues();
				return $this->redirectToRoute($this->getNewRoute(), $params);
			}
		}
	
		$viewParams['categoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	protected function initSubcategoryForm(Request $request, array &$params) {
		$viewParams = $params['viewParams'];
		$contextParams = $params['contextParams'];
		$subcategoryFilter = $viewParams['subcategoryFilter'];
	
		$category = $contextParams['category'];
		
		$tokenStorage = $this->get('security.token_storage');
		$user = $tokenStorage->getToken()->getUser()->getId();
		$form = $this->createForm(SubcategoryFilterType::class, $subcategoryFilter, ['user' => $user, 'category' => $category]);
		
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			if ($form->get('submit')->isClicked()) {
				$params = $subcategoryFilter->getRequestValues();
				return $this->redirectToRoute($this->getNewRoute(), $params);
			}
		}
	
		$viewParams['subcategoryFilterForm'] = $form->createView();
		$params['viewParams'] = $viewParams;
		
		return null;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		/** @var BrandRepository $brandRepository */
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$options['brands'] = $brandRepository->findFilterItems();
	
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$options['categories'] = $categoryRepository->findFilterItems();
	
		return $options;
	}
	
	protected function prepareEntry(&$entry, $params) {
		/** @var Product $entry */
		$entry->setCustom(true);
		
		return $entry;
	}
	
	protected function saveMore($entry, $params) {
		parent::saveMore($entry, $params);
		
		/** @var Product $entry */
		if(count($entry->getProductCategoryAssignments()) == 0) {
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
		}
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getShowRole() {
		return 'ROLE_BENCHMARK';
	}
	
	protected function getEditRole() {
		return 'ROLE_BENCHMARK';
	}
	
	protected function getDeleteRole() {
		return 'ROLE_BENCHMARK';
	}
	
	//---------------------------------------------------------------------------
	// Permissions
	//---------------------------------------------------------------------------
	
	protected function isAdmin() {
		return false;
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	protected function getEntityRepository() {
		$em = $this->getDoctrine()->getManager();
		return new CustomProductRepository($em, $em->getClassMetadata(Product::class));
	}
	
	protected function getEditorFormType() {
		return CustomProductEditorType::class;
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
	
	//---------------------------------------------------------------------------
	// Domain
	//---------------------------------------------------------------------------
	
	protected function getDomain() {
		return 'benchmark';
	}
}