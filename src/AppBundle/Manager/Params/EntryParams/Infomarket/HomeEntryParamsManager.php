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

class HomeEntryParamsManager extends EntryParamsManager {
	
	const NEWS_AC = 4;
	const EVENTS_AC = 14;
	
	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$branch = $viewParams['branch'];
		$categories = array();
		
		foreach ($branch->getBranchCategoryAssignments() as $branchCategoryAssignment) {
			$category = $branchCategoryAssignment->getCategory();
			if($category->getPublished()) {
				$categories[] = $category;
			}
		}
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
    	$categoryRepository = $this->doctrine->getRepository(Category::class);
    	$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
    	$tagRepository = $this->doctrine->getRepository(Tag::class);
		
		
    	$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
    	$articleFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$articleFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
    	$articleFilter->setMain(BaseEntityFilter::TRUE_VALUES);
    	$articleFilter->setCategories($categories);
    	$articleFilter->setOrderBy('e.date DESC');
    	$articleFilter->setLimit(4);
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['featuredArticles'] = $articles;
    	
    	
    	$articleFilter->setFeatured(BaseEntityFilter::ALL_VALUES);
    	
    	
    	$articleCategory = $articleCategoryRepository->find(self::NEWS_AC);
    	$articleFilter->setArticleCategories([$articleCategory]);
    	
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['newsArticles'] = $articles;
    	
    	
    	$articleCategory = $articleCategoryRepository->find(self::EVENTS_AC);
    	$articleFilter->setArticleCategories([$articleCategory]);
    	 
    	$articles = $this->getParamList(Article::class, $articleFilter);
    	$viewParams['eventsArticles'] = $articles;
    	
    	
    	$magazineFilter = new MagazineFilter($userRepository, $categoryRepository);
    	$magazineFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
    	$magazineFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
    	$magazineFilter->setOrderBy('e.orderNumber ASC, e.name DESC');
    	$magazineFilter->setLimit(3);
    	
    	$magazines = $this->getParamList(Magazine::class, $magazineFilter);
    	$viewParams['magazines'] = $magazines;
    	
    	
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}