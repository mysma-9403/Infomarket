<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Form\BranchCategoryAssignmentType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use AppBundle\Entity\Branch;

class BranchCategoryAssignmentController extends AdminEntityController {
	
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
	 * @return \AppBundle\Entity\BranchCategoryAssignment
	 */
	protected function createNewEntity(Request $request) {
		$entity = new BranchCategoryAssignment();
		
		$category = $this->getParamById($request, Category::class, null);
		if($category) {
			$entity->setCategory($category);
		}
		
		$branch = $this->getParamById($request, Branch::class, null);
		if($branch) {
			$entity->setCategory($branch);
		}
		
		return $entity;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return BranchCategoryAssignment::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function getFormType() {
		return BranchCategoryAssignmentType::class;
	}
}