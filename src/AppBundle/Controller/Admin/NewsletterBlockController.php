<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\Filter\NewsletterBlockFilter;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\User;
use AppBundle\Form\Filter\NewsletterBlockFilterType;
use AppBundle\Form\NewsletterBlockType;
use AppBundle\Repository\AdvertRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\NewsletterBlockTemplateRepository;
use AppBundle\Repository\NewsletterPageRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;

class NewsletterBlockController extends SimpleEntityController {
	
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
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewEntity()
	 */
	protected function createNewEntity(Request $request) {
		$entity = new NewsletterBlock();
		
		$newsletterPage = $this->getParamById($request, NewsletterPage::class, null);
		if($newsletterPage) {
			$entity->setNewsletterPage($newsletterPage);
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
	
		$entry->setNewsletterPage($template->getNewsletterPage());
		$entry->setNewsletterBlockTemplate($template->getNewsletterBlockTemplate());
		$entry->setAdvert($template->getAdvert());
		$entry->setArticle($template->getArticle());
	
		return $entry;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::createNewFilter()
	 */
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$newsletterPageRepository = $this->getDoctrine()->getRepository(NewsletterPage::class);
		$newsletterBlockTemplateRepository = $this->getDoctrine()->getRepository(NewsletterBlockTemplate::class);
		$advertRepository = $this->getDoctrine()->getRepository(Advert::class);
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		
		$filter = new NewsletterBlockFilter($userRepository, $newsletterPageRepository, 
				$newsletterBlockTemplateRepository, $advertRepository, $articleRepository);
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
		return NewsletterBlock::class;
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
		return NewsletterBlockType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return NewsletterBlockFilterType::class;
	}
}