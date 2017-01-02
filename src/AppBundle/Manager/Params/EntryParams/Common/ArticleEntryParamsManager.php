<?php

namespace AppBundle\Manager\Params\EntryParams\Common;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;

class ArticleEntryParamsManager extends EntryParamsManager {
	
	public function getPreviewParams(Request $request, array $params, $id, $page) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$category = key_exists('category', $viewParams) ? $viewParams['category'] : null;
		/** @var Article $entry */
		$entry = $viewParams['entry'];
		
		$categories = [];
		if($category) {
			$categories[] = $category;
		} else if($entry) {
			$acas = $entry->getArticleCategoryAssignments();
			foreach($acas as $aca) {
				$categories[] = $aca->getCategory();
			}
		}
		
		
		$articleRepository = $this->doctrine->getRepository(Article::class);
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
		$tagRepository = $this->doctrine->getRepository(Tag::class);
		
		$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
		$articleFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		$articleFilter->setArchived(BaseEntityFilter::FALSE_VALUES);
		$articleFilter->setParents([$entry]);
		$articleFilter->setLimit(1);
		$articleFilter->setOrderBy('e.page DESC');
		
		$lastSubarticle = $articleRepository->findSelected($articleFilter);
		if(count($lastSubarticle) > 0) $pages = $lastSubarticle[0]->getPage();
		else $pages = '1';
		
		$viewParams['pages'] = $pages;
		if($page > $pages) $page = '1';
		$viewParams['page'] = $page;
		
		
		
		$articleFilter->setPages($page);
		$articleFilter->setLimit(100);
		$articleFilter->setOrderBy('e.orderNumber ASC');
		
		$subarticles = $articleRepository->findSelected($articleFilter);
		$viewParams['subarticles'] = $subarticles;
		
		
		
		$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
		$articleFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		$articleFilter->setArchived(BaseEntityFilter::FALSE_VALUES);
		$articleFilter->setCategories($categories);
		$articleFilter->setOrderBy('e.date DESC');
		
		$articles = $articleRepository->findSelected($articleFilter);
		
		
		$size = count($articles);
		for($i = 0; $i < $size; $i++) {
			$curr = $articles[$i];
			if($curr->getId() == $entry->getId()) {
				if($i > 0) $viewParams['prevArticle'] = $articles[$i-1];
				if($i < $size-1) $viewParams['nextArticle'] = $articles[$i+1];
				break;
			}
		}
			
			
		$lastArticles = [];
		$size = min($size, 3);
		for($i = 0; $i < $size; $i++) {
			$lastArticles[] = $articles[$i];
		}
		
		$viewParams['lastArticles'] = $lastArticles;
		
		
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}