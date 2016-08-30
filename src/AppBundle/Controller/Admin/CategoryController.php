<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\ImageTreeController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Form\CategoryType;
use AppBundle\Form\Filter\CategoryFilterType;
use AppBundle\Repository\BranchRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Segment;
use AppBundle\Entity\User;

class CategoryController extends ImageTreeController {
	
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
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function setFeaturedAction(Request $request, $id)
	{
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function setPreleafAction(Request $request, $id)
	{
		return $this->setPreleafActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 */
	public function treeAction(Request $request)
	{
		return $this->treeActionInternal($request);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function ratingsAction(Request $request, $id)
	{
		return $this->ratingsActionInternal($request, $id);
	}
	
	//------------------------------------------------------------------------
	// Internal logic
	//------------------------------------------------------------------------
	
	protected function setPreleafActionInternal(Request $request, $id)
	{
		$preleaf = $request->get('value', false);
	
		$em = $this->getDoctrine()->getManager();
	
		//Make sure entity exists :)
		$entry = $this->getEntry($id);
		$entry->setPreleaf($preleaf);
		$em->persist($entry);
		$em->flush();
	
		$routingParams = $this->getRoutingParams($request);
		return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
	}
	
	protected function treeActionInternal(Request $request)
	{
		$params = $this->getTreeParams($request);
		
		$filter = $this->createTreeFilter($request);
		$filter->initValues($request);
		
		$filterForm = $this->createForm($this->getFilterFormType(), $filter);
		$filterForm->handleRequest($request);
		
		if ($filterForm->isSubmitted() && $filterForm->isValid()) {
		
			if ($filterForm->get('search')->isClicked()) {
				return $this->redirectToRoute($this->getTreeRoute(), $filter->getValues());
			}
		
			if ($filterForm->get('clear')->isClicked()) {
				$filter->clearQueryValues();
				return $this->redirectToRoute($this->getTreeRoute(), $filter->getValues());
			}
		}
		$params['filter'] = $filterForm->createView();
		
		$repository = $this->getRepository();
		
		$filter->setRoot(SimpleEntityFilter::TRUE_VALUES);
		$params['entries'] = $repository->findSelected($filter);
		
		return $this->render($this->getTreeView(), $params);
	}
	
	protected function ratingsActionInternal(Request $request, $id)
	{
		$params = $this->getRatingsParams($request, $id);
		return $this->render($this->getRatingsView(), $params);
	}
	
	protected function getTreeParams(Request $request)
	{
		$params = array();
	
		$routeParams = array();
		$this->registerRequest($request, $this->getTreeRoute(), $routeParams);
	
		$params = array_merge($params, $this->getRoutingParams($request));
		return $params;
	}
	
	protected function getRatingsParams(Request $request, $id)
	{
		$params = array();
	
		$routeParams = array('id' => $id);
		$this->registerRequest($request, $this->getRatingsRoute(), $routeParams);
		
		$entry = $this->getEntry($id);
		$params['entry'] = $entry;
		
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		$segments = $segmentRepository->findAll();
			
		$entry->segments = $segments;
			
		$params = array_merge($params, $this->getRoutingParams($request));
		return $params;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::deleteMore()
	 */
	protected function deleteMore($entry)
	{
		$em = $this->getDoctrine()->getManager();
		foreach ($entry->getBranchCategoryAssignments() as $branchCategoryAssignment) {
			$em->remove($branchCategoryAssignment);
		}
		$em->flush();
	
		return array();
	}
	
	//------------------------------------------------------------------------
	// Entity creators
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewEntity()
	 */
	protected function createNewEntity(Request $request) {
		$entity = new Category();
		
		$parent = $this->getParamByNameId($request, Category::class, 'parent', null);
		if($parent) {
			$entity->setParent($parent);
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
	
		$entry->setSubname($template->getSubname());
		
		$entry->setFeatured($template->getFeatured());
		$entry->setPreleaf($template->getPreleaf());
		
		$entry->setIcon($template->getIcon());
		
		$entry->setParent($template->getParent());
		$entry->setOrderNumber($template->getOrderNumber());
		
		$entry->setContent($template->getContent());
	
		return $entry;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewFilter()
	 */
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		$filter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
	
		return $filter;
	}
	
	/**
	 * 
	 * @param Request $request
	 * @return \AppBundle\Entity\Filter\CategoryFilter
	 */
	protected function createTreeFilter(Request $request) {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		$filter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
		
		return $filter;
	}
	
	
	//------------------------------------------------------------------------
	// Entity types
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return Category::class;
	}
	
	
	//------------------------------------------------------------------------
	// Form types
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getFormType() {
		return CategoryType::class;
	}

	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return CategoryFilterType::class;
	}
	
	protected function getTreeView()
	{
		return $this->getBaseName() . '/' . $this->getEntityName() . '/tree.html.twig';
	}
	
	protected function getRatingsView()
	{
		return $this->getBaseName() . '/' . $this->getEntityName() . '/ratings.html.twig';
	}
	
	protected function getTreeRoute()
    {
    	return $this->getIndexRoute() . '_tree';
    }
    
    protected function getRatingsRoute()
    {
    	return $this->getIndexRoute() . '_ratings';
    }
}