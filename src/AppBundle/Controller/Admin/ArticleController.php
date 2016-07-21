<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\ImageEntityController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Form\ArticleType;
use AppBundle\Form\Filter\ArticleFilterType;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends ImageEntityController {
	
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
	
	public function previewAction(Request $request, $id)
	{
		return $this->previewActionInternal($request, $id);
	}
	
	
	
	//------------------------------------------------------------------------
	// Internal logic
	//------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id current entry ID
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function previewActionInternal(Request $request, $id)
	{
		$params = $this->getPreviewParams($request, $id);
		return $this->render($this->getPreviewView(), $params);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::deleteMore()
	 */
	protected function deleteMore($entry)
	{
		$em = $this->getDoctrine()->getManager();
		foreach ($entry->getArticleArticleCategoryAssignments() as $articleArticleCategoryAssignment) {
			$em->remove($articleArticleCategoryAssignment);
		}
		$em->flush();
		
		foreach ($entry->getArticleCategoryAssignments() as $articleCategoryAssignment) {
			$em->remove($articleCategoryAssignment);
		}
		$em->flush();
		
		foreach ($entry->getChildren() as $subentry) {
			$this->deleteMore($subentry);
			$em->remove($subentry);
		}
		$em->flush();
	
		return array();
	}
	
	protected function getPreviewParams(Request $request, $id)
	{
		$params = array();
		 
		$routeParams = array('id' => $id);
		$this->registerRequest($request, $this->getPreviewRoute(), $routeParams);
		 
		$repository = $this->getEntityRepository();
		$entry = $repository->find($id);
		$params['entry'] = $entry;
		 
		$params = array_merge($params, $this->getRoutingParams($request));
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
		$entity = new Article();
		
		$parent = $this->getParamByNameId($request, Article::class, 'parent', null);
		if($parent) {
			$entity->setParent($parent);
		}
		
		return $entity;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createFromTemplate()
	 */
	protected function createFromTemplate(Request $request, $template) {
		$entry = parent::createFromTemplate($request, $template);
	
		$entry->setSubname($template->getSubname());
		$entry->setFeatured($template->getFeatured());
		
		$entry->setIntro($template->getIntro());
		$entry->setContent($template->getContent());
		
		$entry->setParent($template->getParent());
		$entry->setOrderNumber($template->getOrderNumber());
		$entry->setLayout($template->getLayout());
		$entry->setDisplaySided($template->getDisplaySided());
	
		return $entry;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewFilter()
	 */
	protected function createNewFilter() {
		$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		$filter = new ArticleFilter($articleCategoryRepository, $categoryRepository);
		$filter->setOrderBy('e.createdAt DESC');
		
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
		return Article::class;
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
		return ArticleType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return ArticleFilterType::class;
	}
	
	protected function getPreviewRoute()
	{
		return $this->getIndexRoute() . '_preview';
	}
	
	protected function getPreviewView()
	{
		return $this->getBaseName() . '/' . $this->getEntityName() . '/preview.html.twig';
	}
}