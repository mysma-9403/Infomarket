<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Article;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;

class ArticleManager extends SimpleEntityManager {
	
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
		
		$entry->setAuthor($this->getParamWithName($request, User::class, 'author'));
		$entry->setDate($request->get('date'));
		
		$entry->setLayout($request->get('layout'));
		
		$entry->setDisplayPaginated($request->get('display_paginated'));
		$entry->setDisplaySided($request->get('display_sided'));
		
		$entry->setParent($this->getParamWithName($request, Article::class, 'parent'));
		
		$entry->setOrderNumber($request->get('order_number'));
		
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
		
		$entry->setDisplayPaginated($template->getDisplayPaginated());
		$entry->setDisplaySided($template->getDisplaySided());
		
		$entry->setParent($template->getParent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return Article::class;
	}
}