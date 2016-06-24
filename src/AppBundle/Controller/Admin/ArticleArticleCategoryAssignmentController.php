<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\AdminEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Form\ArticleArticleCategoryAssignmentType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Lists\ArticleArticleCategoryAssignmentListType;

class ArticleArticleCategoryAssignmentController extends AdminEntityController {
	
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
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
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @return \AppBundle\Entity\ArticleArticleCategoryAssignment
	 */
	protected function createNewEntity(Request $request) {
		$entity = new ArticleArticleCategoryAssignment();
		
		$articleCategory = $this->getParamById($request, ArticleCategory::class, null);
		if($articleCategory) {
			$entity->setArticleCategory($articleCategory);
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
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleArticleCategoryAssignment::class;
	}
	
	/**
	 * 
	 * @return string
	 */
	protected function getFormType() {
		return ArticleArticleCategoryAssignmentType::class;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getListFormType()
	 */
	protected function getListFormType() {
		return ArticleArticleCategoryAssignmentListType::class;
	}
}