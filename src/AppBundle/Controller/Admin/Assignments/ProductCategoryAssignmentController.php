<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Admin\Assignments\ProductCategoryAssignmentFilter;
use AppBundle\Form\Editor\Assignments\ProductCategoryAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\ProductCategoryAssignmentFilterType;
use AppBundle\Manager\Entity\Common\ProductCategoryAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use AppBundle\Repository\Admin\Main\ProductRepository;
use AppBundle\Utils\ClassUtils;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Segment;

class ProductCategoryAssignmentController extends BaseEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id)
	{
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	protected function setFeaturedActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getSetFeaturedRoute());
		$params = $this->getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$featured = $request->get('value', false);
		$entry->setFeatured($featured);
	
		$em = $this->getDoctrine()->getManager();
		$em->persist($entry);
		
		if($featured) {
			$product = $entry->getProduct();
			
			$brandName = ClassUtils::getCleanName($product->getBrand()->getName());
			$productName = ClassUtils::getCleanName($product->getName());
			
			$path = '/uploads/products/top-produkt/' . substr($brandName, 0, 1) . '/' . $brandName . '/';
			
			$product->setTopProduktImage($path . $productName . '.png');
			
			$em->persist($product);
		}
		
		$em->flush();
	
		return $this->redirectToReferer($request);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		/** @var ProductRepository $productRepository */
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		$options['products'] = $productRepository->findFilterItems();
	
		/** @var BrandRepository $brandRepository */
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$options['brands'] = $brandRepository->findFilterItems();
		
		/** @var SegmentRepository $segmentRepository */
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		$options['segments'] = $segmentRepository->findFilterItems();
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$options['categories'] = $categoryRepository->findFilterItems();
	
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityManager()
	 */
	protected function getEntityManager($doctrine, $paginator) {
		return new ProductCategoryAssignmentManager($doctrine, $paginator);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new ProductCategoryAssignmentFilter());
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	//TODO should be moved to FeaturedEntityController ???
	//TODO copied from SimpleEntityController :/
	protected function getSetFeaturedRoute()
	{
		return $this->getIndexRoute() . 'set_featured';
	}
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseController::getEntityType()
	 */
	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return ProductCategoryAssignmentEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	 protected function getFilterFormType() {
		return ProductCategoryAssignmentFilterType::class;
	}
}