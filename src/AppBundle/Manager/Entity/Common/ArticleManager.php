<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleManager extends SimpleEntityManager {
	
	private $tokenStorage;
	
	public function __construct($doctrine, $paginator, $tokenStorage) {
		parent::__construct($doctrine, $paginator);
		$this->tokenStorage = $tokenStorage;
	}
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return Article
	 */
	public function createFromRequest(Request $request) {
		/** @var Article $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setSubname($request->get('subname'));
		
		$entry->setFeatured($request->get('featured'));
		
		$entry->setIntro($request->get('intro'));
		$entry->setContent($request->get('content'));
		
		$entry->setDate($request->get('date', new \DateTime()));
		$entry->setEndDate($request->get('end_date'));
		
		$user = $this->tokenStorage->getToken()->getUser();
		$entry->setAuthor($this->getParamWithName($request, User::class, 'author', $user));
		
		$entry->setLayout($request->get('layout', Article::LEFT_LAYOUT));
		$entry->setImageSize($request->get('image_size', Article::MEDIUM_IMAGE));
		
		$entry->setParent($this->getParamWithName($request, Article::class, 'parent'));
		
		$entry->setPage($request->get('order_number', 1));
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param Article $template
	 * 
	 * @return Article
	 */
	public function createFromTemplate($template) {
		/** @var Article $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setSubname($template->getSubname());
		
		$entry->setFeatured($template->getFeatured());
		
		$entry->setIntro($template->getIntro());
		$entry->setContent($template->getContent());
		
		$entry->setAuthor($template->getAuthor());
		$entry->setDate($template->getDate());
		
		$entry->setLayout($template->getLayout());
		$entry->setImageSize($template->getImageSize());
		
		$entry->setParent($template->getParent());
		
		$entry->setPage($template->getPage());
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Article::class;
	}
}