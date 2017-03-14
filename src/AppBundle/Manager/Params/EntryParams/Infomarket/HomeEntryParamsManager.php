<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Category;
use AppBundle\Entity\Magazine;
use AppBundle\Manager\Params\EntryParams\Infomarket\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Infomarket\ArticleCategoryRepository;
use AppBundle\Repository\Infomarket\ArticleRepository;
use AppBundle\Repository\Infomarket\MagazineRepository;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Entity\Brand;

class HomeEntryParamsManager extends EntryParamsManager {
	
	const NEWS_AC = 4;
	const INTERVIEWS_AC = 16;
	const EVENTS_AC = 14;
	const PROMOTIONS_AC = 1;
	const PRODUCTS_AC = 2;
	
	// useful
	const REVIEWS_AC = 15;
	const LAW_AC = 12;
	const HOME_LINKS_AC = 22;
	const FOREIGN_LINKS_AC = 23;
	const MOVIES_AC = 11;
	
	public function getIndexParams(Request $request, array $params, $page) {
		//TODO not needed - change hierarchy?
// 		$params = parent::getIndexParams($request, $params, $page);
		
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$viewParams['route'] = $this->getRoute($request, $params, $page);
		
		$branchId = $contextParams['branch'];
		$categories = $contextParams['categories'];
		
		$em = $this->doctrine->getManager();
		
		$brandRepository = new BrandRepository($em, $em->getClassMetadata(Brand::class));
		
		/** @var ArticleCategoryRepository $articleCategoryRepository */
		$articleCategoryRepository = new ArticleCategoryRepository($em, $em->getClassMetadata(ArticleCategory::class));
    	$articleCategories = $articleCategoryRepository->findHomeItems();
    	$articleCategoriesIds = $articleCategoryRepository->getIds($articleCategories);
		
    	
    	/** @var ArticleRepository $articleRepository */
    	$articleRepository = new ArticleRepository($em, $em->getClassMetadata(Article::class));
		$articles = $articleRepository->findHomeFeaturedItems($categories, $articleCategoriesIds, 3);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['featuredArticles'] = $articles;
    	
    	
    	$viewParams['newsCategory'] = $this->getArticleCategory($articleCategories, self::NEWS_AC);
    	
    	$articles = $articleRepository->findHomeTileItems($categories, self::NEWS_AC, 2);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['newsArticles'] = $articles;
    	
    	$articles = $articleRepository->findHomeListItems($categories, self::NEWS_AC, 2, 14);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['newsListArticles'] = $articles;
    	
    	
    	$viewParams['interviewsCategory'] = $this->getArticleCategory($articleCategories, self::INTERVIEWS_AC);
    	
    	$articles = $articleRepository->findHomeTileItems($categories, self::INTERVIEWS_AC, 6);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['interviewsArticles'] = $articles;
    	
    	
    	$viewParams['eventsCategory'] = $this->getArticleCategory($articleCategories, self::EVENTS_AC);
    	
    	$articles = $articleRepository->findHomeTileItems($categories, self::EVENTS_AC, 3);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['eventsArticles'] = $articles;
    	
    	
    	$viewParams['promotionsCategory'] = $this->getArticleCategory($articleCategories, self::PROMOTIONS_AC);
    	
    	$articles = $articleRepository->findHomeTileItems($categories, self::PROMOTIONS_AC, 8);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['promotionsArticles'] = $articles;
    	
    	
    	$viewParams['productsCategory'] = $this->getArticleCategory($articleCategories, self::PRODUCTS_AC);
    	
    	$articles = $articleRepository->findHomeTileItems($categories, self::PRODUCTS_AC, 8);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['productsArticles'] = $articles;
    	
    	
    	$viewParams['reviewsCategory'] = $this->getArticleCategory($articleCategories, self::REVIEWS_AC);
    	 
    	$articles = $articleRepository->findHomeTileItems($categories, self::REVIEWS_AC, 4);
		if(count($articles) > 0) {
			$articlesIds = $articleRepository->getIds($articles);
			$brands = $brandRepository->findItemsByArticles($articlesIds);
			$articles = $articleRepository->assignItems($articles, $brands, 'brands');
		}
    	$viewParams['reviewsArticles'] = $articles;
    	
    	
    	//useful article categories
    	$usefulArticleCategories = array();
    	
    	$articleCategory = $this->getArticleCategory($articleCategories, self::REVIEWS_AC);
    	if($articleCategory) {
    		$articleCategory['articles'] = $articleRepository->findHomeListItems($categories, self::REVIEWS_AC, 0, 1);
    		$usefulArticleCategories[] = $articleCategory;
    	}
    	
    	$articleCategory = $this->getArticleCategory($articleCategories, self::HOME_LINKS_AC);
    	if($articleCategory) {
    		$articleCategory['articles'] = $articleRepository->findHomeListItems($categories, self::HOME_LINKS_AC, 0, 1);
    		$usefulArticleCategories[] = $articleCategory;
    	}
    	
    	$articleCategory = $this->getArticleCategory($articleCategories, self::FOREIGN_LINKS_AC);
    	if($articleCategory) {
    		$articleCategory['articles'] = $articleRepository->findHomeListItems($categories, self::FOREIGN_LINKS_AC, 0, 1);
    		$usefulArticleCategories[] = $articleCategory;
    	}
    		
    	$viewParams['usefulArticleCategories'] = $usefulArticleCategories;
    	
    	
    	/** @var MagazineRepository $magazineRepository */
    	$magazineRepository = new MagazineRepository($em, $em->getClassMetadata(Magazine::class));
    	$magazines = $magazineRepository->findHomeItems($branchId);
    	$viewParams['magazines'] = $magazines;
    	
    	
    	$ratingsCategory = $this->getFirstRatingsCategory($categories);
		$viewParams['ratingsCategory'] = $ratingsCategory;
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
	
	protected function getArticleCategory(array $articleCategories, $id) {
		foreach($articleCategories as $articleCategory) {
			if($articleCategory['id'] == $id) {
				return $articleCategory;
			}
		}
		return null;
	}
	
	protected function getFirstRatingsCategory($categories) {
// 		foreach($categories as $category) {
// 			if($category->getParent() != null && $category->getParent()->getPreleaf() == true) {
// 				return $category;
// 			}
// 		}
		return null;
	}
}