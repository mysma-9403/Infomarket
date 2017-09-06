<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Main\Advert;
use AppBundle\Entity\Main\Article;
use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Segment;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\Base\EntryParamsManager;
use AppBundle\Manager\Utils\ArticleBrandAssignmentsManager;
use AppBundle\Repository\Infoprodukt\AdvertRepository;
use AppBundle\Repository\Infoprodukt\ArticleCategoryRepository;
use AppBundle\Repository\Infoprodukt\ArticleRepository;
use AppBundle\Repository\Infoprodukt\BrandRepository;
use AppBundle\Repository\Infoprodukt\CategoryRepository;
use AppBundle\Repository\Infoprodukt\ProductRepository;
use AppBundle\Repository\Infoprodukt\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryEntryParamsManager extends EntryParamsManager {

	const MAIN_AC = 17;

	const AUXILIARY_AC = 18;

	const QUESTIONS_AC = 19;

	const BUILDS_AC = 20;

	const SCHEMAS_AC = 21;

	const MOVIES_AC = 11;

	const REVIEWS_AC = 15;

	const PRODUCTS_AC = 2;

	const PROMOTIONS_AC = 1;
	
	// useful section
	const LAW_AC = 12;

	const HOME_LINKS_AC = 22;

	const FOREIGN_LINKS_AC = 23;

	/**
	 *
	 * @var AdvertRepository
	 */
	protected $advertRepository;

	/**
	 *
	 * @var ArticleCategoryRepository
	 */
	protected $articleCategoryRepository;

	/**
	 *
	 * @var ArticleRepository
	 */
	protected $articleRepository;

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
	 * @var ProductRepository
	 */
	protected $productRepository;

	/**
	 *
	 * @var SegmentRepository
	 */
	protected $segmentRepository;

	public function __construct(EntityManager $em, FilterManager $fm, AdvertRepository $advertRepository, 
			ArticleRepository $articleRepository, ArticleCategoryRepository $articleCategoryRepository, 
			BrandRepository $brandRepository, CategoryRepository $categoryRepository, 
			ProductRepository $productRepository, SegmentRepository $segmentRepository, 
			ArticleBrandAssignmentsManager $abaManager) {
		parent::__construct($em, $fm);
		
		$this->advertRepository = $advertRepository;
		$this->articleRepository = $articleRepository;
		$this->articleCategoryRepository = $articleCategoryRepository;
		$this->brandRepository = $brandRepository;
		$this->categoryRepository = $categoryRepository;
		$this->productRepository = $productRepository;
		$this->segmentRepository = $segmentRepository;
		
		$this->abaManager = $abaManager;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		
		$topProducts = $request->get('top_products', false);
		$viewParams['topProducts'] = $topProducts;
		
		$advertLocations = array ();
		
		if (! $topProducts && $entry->getPreleaf()) {
			$advertLocations[] = Advert::FEATURED_LOCATION;
			
			$categories = [ $entry 
			];
			// TODO repository->findBreadcrumbItems($entry);
			// $categories = [$entry];
			// $prev = $entry;
			// while($prev->getParent()) {
			// $prev = $prev->getParent();
			// $categories[] = $prev;
			// }
			
			$contextParams = $params['contextParams'];
			$contextCategories = $contextParams['categories'];
			
			// subcategories
			$categories = $this->categoryRepository->findSubcategories($entry->getId());
			$viewParams['subcategories'] = $categories;
			
			// brands
			$viewParams['brands'] = $this->brandRepository->findTopItems($entry->getId());
			
			//
			$articleCategories = $this->articleCategoryRepository->findHomeItems();
			
			// main articles //TODO refactoring if method is such big that needs comments -> make smaller submethods instead of comments :P
			$viewParams['mainCategory'] = $this->getArticleCategory($articleCategories, self::MAIN_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::MAIN_AC, 12);
			$viewParams['mainArticles'] = $articles;
			
			// auxiliary articles
			$viewParams['auxiliaryCategory'] = $this->getArticleCategory($articleCategories, self::AUXILIARY_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::AUXILIARY_AC, 12);
			$viewParams['auxiliaryArticles'] = $articles;
			
			// questions articles
			$viewParams['questionsCategory'] = $this->getArticleCategory($articleCategories, self::QUESTIONS_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::QUESTIONS_AC, 2);
			$viewParams['questionsArticles'] = $articles;
			
			// builds articles
			$viewParams['buildsCategory'] = $this->getArticleCategory($articleCategories, self::BUILDS_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::BUILDS_AC, 2);
			$viewParams['buildsArticles'] = $articles;
			
			// schemas articles
			$viewParams['schemasCategory'] = $this->getArticleCategory($articleCategories, self::SCHEMAS_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::SCHEMAS_AC, 2);
			$viewParams['schemasArticles'] = $articles;
			
			// movies articles
			$viewParams['moviesCategory'] = $this->getArticleCategory($articleCategories, self::MOVIES_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::MOVIES_AC, 2);
			$viewParams['moviesArticles'] = $articles;
			
			// reviews articles
			$viewParams['reviewsCategory'] = $this->getArticleCategory($articleCategories, self::REVIEWS_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::REVIEWS_AC, 2);
			$viewParams['reviewsArticles'] = $articles;
			
			// products articles
			$viewParams['productsCategory'] = $this->getArticleCategory($articleCategories, self::PRODUCTS_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::PRODUCTS_AC, 6);
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['productsArticles'] = $articles;
			
			// promotions articles
			$viewParams['promotionsCategory'] = $this->getArticleCategory($articleCategories, 
					self::PROMOTIONS_AC);
			
			$articles = $this->articleRepository->findCategoryItems($contextCategories, self::PROMOTIONS_AC, 6);
			if (count($articles) > 0) {
				$articlesIds = $this->articleRepository->getIds($articles);
				$brands = $this->brandRepository->findItemsByArticles($articlesIds);
				$articles = $this->abaManager->assignToItems($articles, $brands);
			}
			$viewParams['promotionsArticles'] = $articles;
			
			// useful article categories
			$usefulArticleCategories = array ();
			
			$articleCategory = $this->getArticleCategory($articleCategories, self::REVIEWS_AC);
			if ($articleCategory) {
				$articleCategory['articles'] = $this->articleRepository->findCategoryItems($contextCategories, 
						self::REVIEWS_AC, 1);
				$usefulArticleCategories[] = $articleCategory;
			}
			
			$articleCategory = $this->getArticleCategory($articleCategories, self::HOME_LINKS_AC);
			if ($articleCategory) {
				$articleCategory['articles'] = $this->articleRepository->findCategoryItems($contextCategories, 
						self::HOME_LINKS_AC, 1);
				$usefulArticleCategories[] = $articleCategory;
			}
			
			$articleCategory = $this->getArticleCategory($articleCategories, self::FOREIGN_LINKS_AC);
			if ($articleCategory) {
				$articleCategory['articles'] = $this->articleRepository->findCategoryItems($contextCategories, 
						self::FOREIGN_LINKS_AC, 1);
				$usefulArticleCategories[] = $articleCategory;
			}
			
			$articleCategory = $this->getArticleCategory($articleCategories, self::LAW_AC);
			if ($articleCategory) {
				$articleCategory['articles'] = $this->articleRepository->findCategoryItems($contextCategories, 
						self::LAW_AC, 1);
				$usefulArticleCategories[] = $articleCategory;
			}
			
			$viewParams['usefulArticleCategories'] = $usefulArticleCategories;
		} else if ($entry->getParent() && $entry->getParent()->getPreleaf()) {
			$viewParams['topBrands'] = $this->brandRepository->findTopItems($entry->getId());
			$viewParams['brands'] = $this->brandRepository->findRecommendedItems($entry->getId());
			
			$viewParams['segments'] = $segments = $this->segmentRepository->findTopItems();
			
			$viewParams['products'] = array ();
			
			foreach ($segments as $segment) {
				$products = $this->productRepository->findTopItems($entry->getId(), $segment['id']);
				$viewParams['products'][$segment['id']] = $products;
			}
			
			$categories = $this->categoryRepository->findSubcategories($entry->getId());
			$viewParams['subcategories'] = $categories;
			
			$viewParams['subproducts'] = array ();
			
			foreach ($categories as $category) {
				$viewParams['subproducts'][$category['id']] = array ();
				
				foreach ($segments as $segment) {
					$products = $this->productRepository->findTopItems($category['id'], $segment['id']);
					$viewParams['subproducts'][$category['id']][$segment['id']] = $products;
				}
			}
		}
		
		if (count($advertLocations) > 0) {
			foreach ($advertLocations as $advertLocation) {
				$adverts = $this->advertRepository->findAdvertItems($advertLocation, $entry->getId());
				$viewParams[Advert::getLocationParam($advertLocation)] = $adverts;
				
				if (count($adverts) > 0) {
					$advertsIds = $this->advertRepository->getIds($adverts);
					$this->advertRepository->updateAdvertsShowCounts($advertsIds);
				}
			}
		}
		
		$viewParams['category'] = $entry;
		
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

	protected function getEntityType() {
		return Category::class;
	}
}