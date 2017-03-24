<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Tag;
use AppBundle\Manager\Entity\Base\FeaturedEntityManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleManager extends FeaturedEntityManager {
	
	private $tokenStorage;
	
	public function __construct($doctrine, $paginator, $tokenStorage) {
		parent::__construct($doctrine, $paginator);
		$this->tokenStorage = $tokenStorage;
	}
	
	public function getEntries($filter, $page) {
		$repository = $this->getRepository();
		$items = parent::getEntries($filter, $page);
		if(count($items) > 0) {
			$itemsIds = $repository->getIds($items);
		
			$brandRepository = $this->getBrandRepository();
			$brands = $brandRepository->findItemsByArticles($itemsIds);
		
			$items = $repository->assignItems($items, $brands, 'brands');
			
			$tagRepository = $this->getTagRepository();
			$tags = $tagRepository->findItemsByArticles($itemsIds);
			
			$items = $repository->assignItems($items, $tags, 'tags');
		}
	
		return $items;
	}
	
	protected function getBrandRepository() {
		return $this->doctrine->getRepository(Brand::class);
	}
	
	protected function getTagRepository() {
		return $this->doctrine->getRepository(Tag::class);
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
		
		$entry->setIntro($request->get('intro'));
		$entry->setContent($request->get('content'));
		
		$entry->setDate($request->get('date', new \DateTime()));
		$entry->setEndDate($request->get('end_date'));
		
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