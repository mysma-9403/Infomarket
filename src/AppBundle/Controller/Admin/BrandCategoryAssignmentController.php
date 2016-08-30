<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Entity\Segment;
use AppBundle\Form\BrandCategoryAssignmentType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\BrandCategoryAssignmentFilter;
use AppBundle\Form\Filter\BrandCategoryAssignmentFilterType;
use AppBundle\Entity\User;

class BrandCategoryAssignmentController extends AdminEntityController {
	
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
	 * @return \AppBundle\Entity\BrandCategoryAssignment
	 */
	protected function createNewEntity(Request $request) {
		$entity = new BrandCategoryAssignment();
		
		$category = $this->getParamById($request, Category::class, null);
		if($category) {
			$entity->setCategory($category);
		}
		
		$segment = $this->getParamById($request, Segment::class, null);
		if($segment) {
			$entity->setSegment($segment);
		}
		
		$brand = $this->getParamById($request, Brand::class, null);
		if($brand) {
			$entity->setBrand($brand);
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
		$entry->setBrand($template->getBrand());
		
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
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
	
		return new BrandCategoryAssignmentFilter($userRepository, $brandRepository, $categoryRepository, $segmentRepository);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return BrandCategoryAssignment::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function getFormType() {
		return BrandCategoryAssignmentType::class;
	}
	
	/**
	 *
	 * @return string
	 */
	protected function getFilterFormType() {
		return BrandCategoryAssignmentFilterType::class;
	}
}