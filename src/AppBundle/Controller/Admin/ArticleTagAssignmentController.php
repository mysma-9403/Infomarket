<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Filter\ArticleTagAssignmentFilter;
use AppBundle\Entity\Tag;
use AppBundle\Form\ArticleTagAssignmentType;
use AppBundle\Form\Filter\ArticleTagAssignmentFilterType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class ArticleTagAssignmentController extends AdminEntityController {
	
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
	// Internal logic
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::prepareEntry()
	 */
	protected function prepareEntry($entry) {
		if($entry->getTag()) return;
		
		$tagRepository = $this->getDoctrine()->getRepository(Tag::class);
		
		$result = $tagRepository->findBy([ 'name' => $entry->getNewTagName() ], null, 1);
		
		if(count($result) == 0) {
			$em = $this->getDoctrine()->getManager();
			
			$tag = new Tag();
			$tag->setName($entry->getNewTagName());
			$tag->setPublished(true);
				
			$em->persist($tag);
			$em->flush();
			
			$result = $tagRepository->findBy([ 'name' => $entry->getNewTagName() ], null, 1);
		}
		
		$entry->setTag($result[0]);
	}
	
	//------------------------------------------------------------------------
	// Entity creators
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * @param Request $request
	 * @return \AppBundle\Entity\ArticleTagAssignment
	 */
	protected function createNewEntity(Request $request) {
		$entity = new ArticleTagAssignment();
		
		$brand = $this->getParamById($request, Tag::class, null);
		if($brand) {
			$entity->setTag($brand);
		}
		
		$article = $this->getParamById($request, Article::class, null);
		if($article) {
			$entity->setArticle($article);
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
	
		$entry->setArticle($template->getArticle());
		$entry->setTag($template->getTag());
	
		return $entry;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::createNewFilter()
	 */
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$brandRepository = $this->getDoctrine()->getRepository(Tag::class);
		
		return new ArticleTagAssignmentFilter($userRepository, $articleRepository, $brandRepository);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleTagAssignment::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function getFormType() {
		return ArticleTagAssignmentType::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	 protected function getFilterFormType() {
		return ArticleTagAssignmentFilterType::class;
	}
}