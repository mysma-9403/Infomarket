<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infomarket\Base\EntryParamsManager;
use AppBundle\Manager\Utils\ArticleBrandAssignmentsManager;
use AppBundle\Repository\Infomarket\ArticleCategoryRepository;
use AppBundle\Repository\Infomarket\ArticleRepository;
use AppBundle\Repository\Infomarket\BranchRepository;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use AppBundle\Repository\Infomarket\MagazineRepository;
use Symfony\Component\HttpFoundation\Request;

class HomeEntryParamsManager extends EntryParamsManager {

	const NEWS_AC = 4;

	const INTERVIEWS_AC = 16;

	const EVENTS_AC = 14;

	const PROMOTIONS_AC = 1;

	const PRODUCTS_AC = 2;
	
	const REVIEWS_AC = 15;
	

	/**
	 *
	 * @var BranchRepository
	 */
	protected $branchRepository;

	/**
	 *
	 * @var BrandRepository
	 */
	protected $brandRepository;

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 *
	 * @var ArticleRepository
	 */
	protected $articleRepository;

	/**
	 *
	 * @var ArticleCategoryRepository
	 */
	protected $articleCategoryRepository;

	/**
	 *
	 * @var MagazineRepository
	 */
	protected $magazineRepository;

	/**
	 *
	 * @var ArticleBrandAssignmentsManager
	 */
	protected $abaManager;

	public function __construct(EntityManager $em, FilterManager $fm, ArticleRepository $articleRepository, 
			ArticleCategoryRepository $articleCategoryRepository, BranchRepository $branchRepository, 
			BrandRepository $brandRepository, CategoryRepository $categoryRepository, 
			MagazineRepository $magazineRepository, ArticleBrandAssignmentsManager $abaManager) {
		parent::__construct($em, $fm);
		
		$this->articleRepository = $articleRepository;
		$this->articleCategoryRepository = $articleCategoryRepository;
		$this->branchRepository = $branchRepository;
		$this->brandRepository = $brandRepository;
		$this->brandRepository = $brandRepository;
		$this->categoryRepository = $categoryRepository;
		$this->magazineRepository = $magazineRepository;
		
		$this->abaManager = $abaManager;
	}

	public function getIndexParams(Request $request, array $params, $page) {
		// TODO not needed - change hierarchy?
		// $params = parent::getIndexParams($request, $params, $page);
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$viewParams['route'] = $this->getRoute($request, $params, $page);
		
		$branchId = $contextParams['branch'];
		if ($branchId > 0) {
			$categories = $contextParams['categories'];
			
			$articleCategories = $this->articleCategoryRepository->findHomeItems();
			$articleCategoriesIds = $this->articleCategoryRepository->getIds($articleCategories);
			
			$articles = [];
			if (count($categories) > 0 && count($articleCategoriesIds)) {
				$articles = $this->articleRepository->findHomeFeaturedItems($categories, $articleCategoriesIds, 
						3);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['featuredArticles'] = $articles;
			
			$viewParams['newsCategory'] = $this->getArticleCategory($articleCategories, self::NEWS_AC);
			
			$articles = [];
			if (count($categories) > 0) {
				$articles = $this->articleRepository->findHomeTileItems($categories, self::NEWS_AC, 2);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['newsArticles'] = $articles;
			
			$articles = [];
			if (count($categories) > 0) {
				$articles = $this->articleRepository->findHomeListItems($categories, self::NEWS_AC, 2, 14);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['newsListArticles'] = $articles;
			
			$viewParams['interviewsCategory'] = $this->getArticleCategory($articleCategories, 
					self::INTERVIEWS_AC);
			
			$articles = [];
			if (count($categories) > 0) {
				$articles = $this->articleRepository->findHomeTileItems($categories, self::INTERVIEWS_AC, 6);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['interviewsArticles'] = $articles;
			
			$viewParams['eventsCategory'] = $this->getArticleCategory($articleCategories, self::EVENTS_AC);
			
			$articles = [];
			if (count($categories) > 0) {
				$articles = $this->articleRepository->findHomeTileItems($categories, self::EVENTS_AC, 3);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['eventsArticles'] = $articles;
			
			$viewParams['promotionsCategory'] = $this->getArticleCategory($articleCategories, 
					self::PROMOTIONS_AC);
			
			$articles = [];
			if (count($categories) > 0) {
				$articles = $this->articleRepository->findHomeTileItems($categories, self::PROMOTIONS_AC, 8);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['promotionsArticles'] = $articles;
			
			$viewParams['productsCategory'] = $this->getArticleCategory($articleCategories, self::PRODUCTS_AC);
			
			$articles = [];
			if (count($categories) > 0) {
				$articles = $this->articleRepository->findHomeTileItems($categories, self::PRODUCTS_AC, 8);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['productsArticles'] = $articles;
			
			$viewParams['reviewsCategory'] = $this->getArticleCategory($articleCategories, self::REVIEWS_AC);
			
			$articles = [];
			if (count($categories) > 0) {
				$articles = $this->articleRepository->findHomeTileItems($categories, self::REVIEWS_AC, 4);
			}
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['reviewsArticles'] = $articles;
			
			$magazines = $this->magazineRepository->findHomeItems($branchId);
			$viewParams['magazines'] = $magazines;
			
			$ratingsCategory = $this->getFirstRatingsCategory($categories);
			$viewParams['ratingsCategory'] = $ratingsCategory;
		} else {
			$branches = $this->branchRepository->findBy(['infomarket' => true], [
					'orderNumber' => 'ASC']);
			$viewParams['branches'] = $branches;
		}
		
		$params['viewParams'] = $viewParams;
		return $params;
	}

	protected function getArticleCategory(array $articleCategories, $id) {
		foreach ($articleCategories as $articleCategory) {
			if ($articleCategory['id'] == $id) {
				return $articleCategory;
			}
		}
		return null;
	}

	protected function getFirstRatingsCategory($categories) {
		// foreach($categories as $category) {
		// if($category->getParent() != null && $category->getParent()->getPreleaf() == true) {
		// return $category;
		// }
		// }
		return null;
	}
}