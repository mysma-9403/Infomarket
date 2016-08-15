<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\Term;
use AppBundle\Entity\TermCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\TermCategoryAssignmentFilter;
use AppBundle\Form\TermCategoryAssignmentType;
use AppBundle\Form\Filter\TermCategoryAssignmentFilterType;
use Symfony\Component\HttpFoundation\Request;

class TermCategoryAssignmentController extends AdminEntityController {
	
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
	 * @return \AppBundle\Entity\TermCategoryAssignment
	 */
	protected function createNewEntity(Request $request) {
		$entity = new TermCategoryAssignment();
		
		$category = $this->getParamById($request, Category::class, null);
		if($category) {
			$entity->setCategory($category);
		}
		
		$term = $this->getParamById($request, Term::class, null);
		if($term) {
			$entity->setTerm($term);
		}
		
		return $entity;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::createFromTemplate()
	 */
	protected function createFromTemplate(Request $request, $template) {
		$entry = parent::createFromTemplate($request, $template);
	
		$entry->setTerm($template->getTerm());
		$entry->setCategory($template->getCategory());
	
		return $entry;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::createNewFilter()
	 */
	protected function createNewFilter() {
		$advertRepository = $this->getDoctrine()->getRepository(Term::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		return new TermCategoryAssignmentFilter($advertRepository, $categoryRepository);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return TermCategoryAssignment::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function getFormType() {
		return TermCategoryAssignmentType::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	 protected function getFilterFormType() {
		return TermCategoryAssignmentFilterType::class;
	}
}