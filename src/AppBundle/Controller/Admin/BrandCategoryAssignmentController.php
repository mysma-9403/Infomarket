<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Form\BrandCategoryAssignmentType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Segment;

class BrandCategoryAssignmentController extends AdminEntityController {
	
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
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
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
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
}