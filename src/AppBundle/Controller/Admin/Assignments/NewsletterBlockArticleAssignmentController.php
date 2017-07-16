<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockArticleAssignment;
use AppBundle\Filter\Admin\Assignments\NewsletterBlockArticleAssignmentFilter;
use AppBundle\Form\Editor\Assignments\NewsletterBlockArticleAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterBlockArticleAssignmentFilterType;
use AppBundle\Manager\Entity\Common\NewsletterBlockArticleAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\ArticleRepository;
use AppBundle\Repository\Admin\Main\NewsletterBlockRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Base\BaseType;

class NewsletterBlockArticleAssignmentController extends AssignmentController {
	
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
	
		/** @var NewsletterBlockRepository $newsletterBlockRepository */
		$newsletterBlockRepository = $this->getDoctrine()->getRepository(NewsletterBlock::class);
		$options[BaseType::getChoicesName('newsletterBlock')] = $newsletterBlockRepository->findFilterItems();
	
		/** @var ArticleRepository $articleRepository */
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$options[BaseType::getChoicesName('article')] = $articleRepository->findFilterItems();
	
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
	
		/** @var NewsletterBlockRepository $newsletterBlockRepository */
		$newsletterBlockRepository = $this->getDoctrine()->getRepository(NewsletterBlock::class);
		$options[BaseType::getChoicesName('newsletterBlock')] = $newsletterBlockRepository->findFilterItems();
	
		/** @var ArticleRepository $articleRepository */
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$options[BaseType::getChoicesName('article')] = $articleRepository->findFilterItems();
	
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
		return new NewsletterBlockArticleAssignmentManager($doctrine, $paginator);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Base\BaseEntityController::getFilterManager()
	 */
	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterBlockArticleAssignmentFilter());
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
		return NewsletterBlockArticleAssignment::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return NewsletterBlockArticleAssignmentEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::getFilterFormType()
	 */
	 protected function getFilterFormType() {
		return NewsletterBlockArticleAssignmentFilterType::class;
	}
}