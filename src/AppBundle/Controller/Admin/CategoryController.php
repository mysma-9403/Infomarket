<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\ImageTreeController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Form\CategoryType;
use AppBundle\Repository\BranchRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends ImageTreeController {
	
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
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
	
	public function setPublishedAction(Request $request, $id)
	{
		return $this->setPublishedActionInternal($request, $id);
	}
	
	public function setFeaturedAction(Request $request, $id)
	{
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	public function setPreleafAction(Request $request, $id)
	{
		return $this->setPreleafActionInternal($request, $id);
	}
	
	public function treeAction(Request $request)
	{
		return $this->treeActionInternal($request);
	}
	
	public function ratingsAction(Request $request, $id)
	{
		return $this->ratingsActionInternal($request, $id);
	}
	
	protected function setPreleafActionInternal(Request $request, $id)
	{
		$preleaf = $request->get('preleaf', false);
	
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
		$entry = $this->getEntry($id);
		
		$params = $this->getEditParams($request, $entry);
		$routingParams = $params['routingParams'];
		
		$form = $this->createForm($this->getFormType(), $entry);
	
		$form->handleRequest($request);
	
		if ($form->isSubmitted() && $form->isValid())
		{
			$this->saveEntry($entry);
	
			$this->addFlash('success', 'info.entry.created_successfully'); //TODO label
			
			if ($form->get('saveAndQuit')->isClicked()) {
				$routingParams = $this->getRoutingParams($request);
				return $this->redirectToRoute($routingParams['route'], $routingParams['routeParams']);
			}
		}
		$params['entry'] = $entry;
		$params['form'] = $form->createView();
	
		return $this->render($this->getRatingsView(), $params);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getEditParams()
	 */
	protected function getEditParams(Request $request, $entry)
	{
		$params = parent::getEditParams($request, $entry);
	
		$entry = $params['entry'];
		
		
		
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		$segments = $segmentRepository->findAll();
			
		$entry->segments = $segments;
			
		$entry->products = array();
		$entry->brands = array();

		//TODO use as setters as they are useless in many cases!!! (like here)
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		
		//TODO nie zadziala dla new :( -> przeniesc do tree
		foreach ($segments as $segment) {
			$brandFilter = new BrandFilter($categoryRepository, $segmentRepository);
			//TODO nie zadziala dla new :( -> przeniesc do tree
// 			$brandFilter->setCategories([$entry]);
			$brandFilter->setSegments([$segment]);
			$brandFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);

			$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
			$brands = $brandRepository->findSelected($brandFilter);

			$entry->brands[$segment->getId()] = $brands;

			$productFilter = new ProductFilter($categoryRepository, $brandRepository, $segmentRepository);
			//TODO nie zadziala dla new :( -> przeniesc do tree
// 			$productFilter->setCategories([$entry]);
			$productFilter->setSegments([$segment]);
			$productFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);

			$productRepository = $this->getDoctrine()->getRepository(Product::class);
			$products = $productRepository->findSelected($productFilter);

			$entry->products[$segment->getId()] = $products;
		}
		
		if(count($segments) > 0) {
			if(count($entry->brands[$segments[0]->getId()]) > 0) $entry->brand1_1 = $entry->brands[$segments[0]->getId()][0];
		}
		
		$params['entry'] = $entry;
	
		return $params;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getEditParams()
	 */
	protected function getTreeParams(Request $request)
	{
		$params = parent::getParams($request);
		return $params;
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
		
		$parent = $this->getParamById($request, Category::class, null);
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
	
		$entry->setContent($template->getContent());
		$entry->setIcon($template->getIcon());
		$entry->setParent($template->getParent());
		$entry->setPreleaf($template->getPreleaf());
		$entry->setSubname($template->getSubname());
	
		return $entry;
	}
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewEntity()
	 */
	protected function createTreeFilter(Request $request) {
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$filter = new CategoryFilter($branchRepository, $categoryRepository);
		
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