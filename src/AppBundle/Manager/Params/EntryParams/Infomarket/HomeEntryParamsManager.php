<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\MagazineFilter;
use AppBundle\Entity\Magazine;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Filter\ArticleCategoryFilter;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Advert;

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
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$branch = $viewParams['branch'];
		$categories = array();
		
		$ratingsCategory = null;
		
		foreach ($branch->getBranchCategoryAssignments() as $branchCategoryAssignment) {
			$category = $branchCategoryAssignment->getCategory();
			if($category->getPublished()) {
				$categories[] = $category;
				
				if($category->getParent() != null && $category->getParent()->getPreleaf() == true) {
					$ratingsCategory = $category;
				}
			}
		}
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
    	$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
    	$tagRepository = $this->doctrine->getRepository(Tag::class);
    	
    	
    	$articleCategoryFilter = new ArticleCategoryFilter($userRepository);
    	$articleCategoryFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$articleCategoryFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	
    	$articleCategories = $articleCategoryRepository->findSelected($articleCategoryFilter);
		
		
    	$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
    	$articleFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$articleFilter->setArchived(BaseEntityFilter::FALSE_VALUES);
    	$articleFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$articleFilter->setMain(BaseEntityFilter::TRUE_VALUES);
    	$articleFilter->setArticleCategories($articleCategories);
    	$articleFilter->setCategories($categories);
    	$articleFilter->setOrderBy('e.date DESC');
    	$articleFilter->setLimit(3);
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['featuredArticles'] = $articles;
    	
    	
    	$articleFilter->setFeatured(BaseEntityFilter::ALL_VALUES);
    	
    	
    	
    	
    	$articleFilter->setLimit(12);
    	
    	$articleCategory = $articleCategoryRepository->find(self::NEWS_AC);
    	$articleFilter->setArticleCategories([$articleCategory]);
    	$viewParams['newsCategory'] = $articleCategory;
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['newsArticles'] = $articles;
    	
    	
    	
    	
    	$articleFilter->setLimit(6);
    	
    	$articleCategory = $articleCategoryRepository->find(self::INTERVIEWS_AC);
    	$articleFilter->setArticleCategories([$articleCategory]);
    	$viewParams['interviewsCategory'] = $articleCategory;
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['interviewsArticles'] = $articles;
    	
    	
    	
    	
    	$articleFilter->setLimit(3);
    	
    	$articleCategory = $articleCategoryRepository->find(self::EVENTS_AC);
    	$articleFilter->setArticleCategories([$articleCategory]);
    	$viewParams['eventsCategory'] = $articleCategory;
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['eventsArticles'] = $articles;
    	
    	
    	
    	
    	$articleFilter->setLimit(8);
    	
    	$articleCategory = $articleCategoryRepository->find(self::PROMOTIONS_AC);
    	$articleFilter->setArticleCategories([$articleCategory]);
    	$viewParams['promotionsCategory'] = $articleCategory;
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['promotionsArticles'] = $articles;
    	
    	
    	
    	$articleFilter->setLimit(8);
    	
    	$articleCategory = $articleCategoryRepository->find(self::PRODUCTS_AC);
    	$articleFilter->setArticleCategories([$articleCategory]);
    	$viewParams['productsCategory'] = $articleCategory;
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['productsArticles'] = $articles;
    	
    	
    	
    	
    	//useful article categories
    	$usefulArticleCategories = array();
    		
    	$usefulArticleCategories[] = $articleCategoryRepository->find(self::REVIEWS_AC);
    	$usefulArticleCategories[] = $articleCategoryRepository->find(self::LAW_AC);
    	$usefulArticleCategories[] = $articleCategoryRepository->find(self::HOME_LINKS_AC);
    	$usefulArticleCategories[] = $articleCategoryRepository->find(self::FOREIGN_LINKS_AC);
    	$usefulArticleCategories[] = $articleCategoryRepository->find(self::MOVIES_AC);
    		
    	$viewParams['usefulArticleCategories'] = $usefulArticleCategories;
    	
    	
    	
    	
    	$magazineFilter = new MagazineFilter($userRepository, $categoryRepository);
    	$magazineFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$magazineFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	$magazineFilter->setOrderBy('e.orderNumber ASC, e.name DESC');
    	$magazineFilter->setLimit(4);
    	
    	$magazines = $this->getParamList(Magazine::class, $magazineFilter);
    	$viewParams['magazines'] = $magazines;
    	
    	
    	
    	$advertFilter = new AdvertFilter($userRepository, $categoryRepository);
    	$advertFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$advertFilter->setActive(BaseEntityFilter::TRUE_VALUES);
		$advertFilter->setCategories($categories);
			
		$advertFilter->setLocations([Advert::FEATURED_LOCATION]);
			
		$featuredAds = $this->getParamList(Advert::class, $advertFilter);
		shuffle($featuredAds);
		$featuredAds = array_slice($featuredAds, 0, 3);
		$viewParams['featuredAds'] = $featuredAds;
		
		
		$viewParams['ratingsCategory'] = $ratingsCategory;
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}