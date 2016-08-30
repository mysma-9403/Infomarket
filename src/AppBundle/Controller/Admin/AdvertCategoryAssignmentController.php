<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\Advert;
use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertCategoryAssignmentFilter;
use AppBundle\Form\AdvertCategoryAssignmentType;
use AppBundle\Form\Filter\AdvertCategoryAssignmentFilterType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class AdvertCategoryAssignmentController extends AdminEntityController {
	
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
	 * @return \AppBundle\Entity\AdvertCategoryAssignment
	 */
	protected function createNewEntity(Request $request) {
		$entity = new AdvertCategoryAssignment();
		
		$category = $this->getParamById($request, Category::class, null);
		if($category) {
			$entity->setCategory($category);
		}
		
		$advert = $this->getParamById($request, Advert::class, null);
		if($advert) {
			$entity->setAdvert($advert);
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
	
		$entry->setAdvert($template->getAdvert());
		$entry->setCategory($template->getCategory());
	
		return $entry;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::createNewFilter()
	 */
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$advertRepository = $this->getDoctrine()->getRepository(Advert::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		return new AdvertCategoryAssignmentFilter($userRepository, $advertRepository, $categoryRepository);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return AdvertCategoryAssignment::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function getFormType() {
		return AdvertCategoryAssignmentType::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	 protected function getFilterFormType() {
		return AdvertCategoryAssignmentFilterType::class;
	}
}