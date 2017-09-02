<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\Article;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Infomarket\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;

class ArticleEntryParamsManager extends EntryParamsManager {

	public function getPreviewParams(Request $request, array $params, $id, $page) {
		$params = parent::getShowParams($request, $params, $id);
		
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		/** @var Article $entry */
		// TODO make scalar too
		$entry = $viewParams['entry'];
		
		$em = $this->doctrine->getManager();
		$articleRepository = $this->getRepository($em);
		
		$pages = $articleRepository->findLastPage($entry->getId());
		
		$viewParams['pages'] = $pages;
		if ($page > $pages)
			$page = $pages;
		$viewParams['page'] = $page;
		
		$subarticles = $articleRepository->findChildren($entry->getId(), $page);
		$viewParams['subarticles'] = $subarticles;
		
		if (key_exists('categories', $contextParams)) {
			$contextCategories = $contextParams['categories'];
			$articlesIds = $articleRepository->findItemsIds($contextCategories);
			
			$count = 0;
			$lastArticlesIds = array ();
			
			$prevArticleId = null;
			$nextArticleId = null;
			
			$size = count($articlesIds);
			for ($i = 0; $i < $size; $i ++) {
				$id = $articlesIds[$i];
				if ($id == $entry->getId()) {
					if ($i > 0)
						$prevArticleId = $articlesIds[$i - 1];
					if ($i < $size - 1)
						$nextArticleId = $articlesIds[$i + 1];
				} else if ($count < 3) {
					$lastArticlesIds[] = $articlesIds[$i];
					$count ++;
				}
			}
			
			$viewParams['lastArticles'] = count($lastArticlesIds) > 0 ? $articleRepository->findItemsByIds($lastArticlesIds) : [ ];
			if ($prevArticleId)
				$viewParams['prevArticle'] = $articleRepository->findItem($prevArticleId);
			if ($nextArticleId)
				$viewParams['nextArticle'] = $articleRepository->findItem($nextArticleId);
		}
		
		$params['viewParams'] = $viewParams;
		return $params;
	}

	protected function getRepository($em) {
		return new ArticleRepository($em, $em->getClassMetadata(Article::class));
	}
}