<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Article;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\Base\EntryParamsManager;
use AppBundle\Repository\Infoprodukt\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;

class ArticleEntryParamsManager extends EntryParamsManager {
	
	/**
	 *
	 * @var ArticleRepository
	 */
	protected $articleRepository;
	
	public function __construct(EntityManager $em, FilterManager $fm, ArticleRepository $articleRepository) {
		parent::__construct($em, $fm);
	
		$this->articleRepository = $articleRepository;
	}
	
	public function getPreviewParams(Request $request, array $params, $id, $page) {
		$params = parent::getShowParams($request, $params, $id);
	
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
	
		/** @var Article $entry */ //TODO make scalar too
		$entry = $viewParams['entry'];
	
		$pages = $this->articleRepository->findLastPage($entry->getId());
	
		$viewParams['pages'] = $pages;
		if($page > $pages) $page = $pages;
		$viewParams['page'] = $page;
	
		$subarticles = $this->articleRepository->findChildren($entry->getId(), $page);
		$viewParams['subarticles'] = $subarticles;
	
		if(key_exists('categories', $contextParams)) {
			$contextCategories = $contextParams['categories'];
			$articlesIds = $this->articleRepository->findItemsIds($contextCategories);
	
			$count = 0;
			$lastArticlesIds = array();
	
			$prevArticleId = null;
			$nextArticleId = null;
	
			$size = count($articlesIds);
			for($i = 0; $i < $size; $i++) {
				$id = $articlesIds[$i];
				if($id == $entry->getId()) {
					if($i > 0) $prevArticleId = $articlesIds[$i-1];
					if($i < $size-1) $nextArticleId = $articlesIds[$i+1];
				} else if($count < 3) {
					$lastArticlesIds[] = $articlesIds[$i];
					$count++;
				}
			}
	
			$viewParams['lastArticles'] = count($lastArticlesIds) > 0 ? $this->articleRepository->findItemsByIds($lastArticlesIds) : [];
			if($prevArticleId) $viewParams['prevArticle'] = $this->articleRepository->findItem($prevArticleId);
			if($nextArticleId) $viewParams['nextArticle'] = $this->articleRepository->findItem($nextArticleId);
		}
	
		$params['viewParams'] = $viewParams;
		return $params;
	}
}