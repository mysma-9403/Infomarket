<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleArticleCategoryAssignment;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Filter\Admin\Assignments\ArticleArticleCategoryAssignmentFilter;
use AppBundle\Form\Editor\Admin\Assignments\ArticleArticleCategoryAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\ArticleArticleCategoryAssignmentFilterType;
use AppBundle\Manager\Entity\Common\ArticleArticleCategoryAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\ArticleCategoryRepository;
use AppBundle\Repository\Admin\Main\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Form\Base\BaseType;

class ArticleArticleCategoryAssignmentController extends AssignmentController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param integer $page
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		/** @var ArticleRepository $articleRepository */
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$options[BaseType::getChoicesName('articles')] = $articleRepository->findFilterItems();
	
		/** @var ArticleCategoryRepository $articleArticleCategoryRepository */
		$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
		$options[BaseType::getChoicesName('articleCategories')] = $articleCategoryRepository->findFilterItems();
	
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
	
		/** @var ArticleRepository $articleRepository */
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$options[BaseType::getChoicesName('article')] = $articleRepository->findFilterItems();
	
		/** @var ArticleCategoryRepository $articleArticleCategoryRepository */
		$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
		$options[BaseType::getChoicesName('articleCategory')] = $articleCategoryRepository->findFilterItems();
	
		return $options;
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getEntityManager()
	 */
	protected function getEntityManager($doctrine, $paginator) {
		return new ArticleArticleCategoryAssignmentManager($doctrine, $paginator);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new ArticleArticleCategoryAssignmentFilter());
	}
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseController::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleArticleCategoryAssignment::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return ArticleArticleCategoryAssignmentEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	 protected function getFilterFormType() {
		return ArticleArticleCategoryAssignmentFilterType::class;
	}
}