<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Segment;
use AppBundle\Form\ProductCategoryAssignmentType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\ProductCategoryAssignmentFilter;
use AppBundle\Form\Filter\ProductCategoryAssignmentFilterType;
use AppBundle\Entity\User;

class ProductCategoryAssignmentController extends AdminEntityController {
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $page
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param unknown $id
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param unknown $id
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param unknown $id
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function setPublishedAction(Request $request, $id)
	{
		return $this->setPublishedActionInternal($request, $id);
	}
	
	//------------------------------------------------------------------------
	// Entity creators
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * @param Request $request
	 * @return \AppBundle\Entity\ProductCategoryAssignment
	 */
	protected function createNewEntity(Request $request) {
		$entity = new ProductCategoryAssignment();
		
		$category = $this->getParamById($request, Category::class, null);
		if($category) {
			$entity->setCategory($category);
		}
		
		$segment = $this->getParamById($request, Segment::class, null);
		if($segment) {
			$entity->setSegment($segment);
		}
		
		$product = $this->getParamById($request, Product::class, null);
		if($product) {
			$entity->setProduct($product);
		}
		
		$entity->setOrderNumber(1);
		
		return $entity;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::createFromTemplate()
	 */
	protected function createFromTemplate(Request $request, $template) {
		$entry = parent::createFromTemplate($request, $template);
	
		$entry->setCategory($template->getCategory());
		$entry->setSegment($template->getSegment());
		$entry->setProduct($template->getProduct());
		
		$entry->setOrderNumber($template->getOrderNumber());
	
		return $entry;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::createNewFilter()
	 */
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
	
		return new ProductCategoryAssignmentFilter($userRepository, $productRepository, $categoryRepository, $segmentRepository);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function getFormType() {
		return ProductCategoryAssignmentType::class;
	}
	
	/**
	 *
	 * @return string
	 */
	protected function getFilterFormType() {
		return ProductCategoryAssignmentFilterType::class;
	}
}