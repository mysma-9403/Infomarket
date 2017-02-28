<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
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
	
	
	// useful
	const LAW_AC = 12;
	const HOME_LINKS_AC = 22;
	const FOREIGN_LINKS_AC = 23;
	
	
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		
		$topProducts = $request->get('top_products', false);
		$viewParams['topProducts'] = $topProducts;
		
		$advertLocations = array();
		
		if(!$topProducts && $entry->getPreleaf()) {
			$advertLocations[] = Advert::FEATURED_LOCATION;
			
			
			$categories = [$entry];
			//TODO repository->findBreadcrumbItems($entry);
// 			$categories = [$entry];
// 			$prev = $entry;
// 			while($prev->getParent()) {
// 				$prev = $prev->getParent();
// 				$categories[] = $prev;
// 			}

			
			$em = $this->doctrine->getManager();
			
			
			//subcategories
			$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
			$categories = $categoryRepository->findSubcategories($entry->getId());
			$viewParams['subcategories'] = $categories;
			
			//brands
			$brandRepository = new BrandRepository($em, $em->getClassMetadata(Brand::class));
			$viewParams['brands'] = $brandRepository->findTopItems($entry->getId());
			
			
			/** @var ArticleCategoryRepository $articleCategoryRepository */
			$articleCategoryRepository = new ArticleCategoryRepository($em, $em->getClassMetadata(ArticleCategory::class));
			$articleCategories = $articleCategoryRepository->findHomeItems();
			
			/** @var ArticleRepository $articleRepository */
			$articleRepository = new ArticleRepository($em, $em->getClassMetadata(Article::class));
			
			
			//main articles //TODO refactoring if method is such big that needs comments -> make smaller submethods instead of comments :P
			$viewParams['mainCategory'] = $this->getArticleCategory($articleCategories, self::MAIN_AC);
			 
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::MAIN_AC, 12);
			$viewParams['mainArticles'] = $articles;
			
			
			
			//auxiliary articles
			$viewParams['auxiliaryCategory'] = $this->getArticleCategory($articleCategories, self::AUXILIARY_AC);
			
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::AUXILIARY_AC, 12);
			$viewParams['auxiliaryArticles'] = $articles;
			
			
			
			//questions articles
			$viewParams['questionsCategory'] = $this->getArticleCategory($articleCategories, self::QUESTIONS_AC);
				
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::QUESTIONS_AC, 2);
			$viewParams['questionsArticles'] = $articles;
			
			
			
			//builds articles
			$viewParams['buildsCategory'] = $this->getArticleCategory($articleCategories, self::BUILDS_AC);
			
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::BUILDS_AC, 2);
			$viewParams['buildsArticles'] = $articles;
			
			
			
			//schemas articles
			$viewParams['schemasCategory'] = $this->getArticleCategory($articleCategories, self::SCHEMAS_AC);
				
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::SCHEMAS_AC, 2);
			$viewParams['schemasArticles'] = $articles;
			
			
			
			//movies articles
			$viewParams['moviesCategory'] = $this->getArticleCategory($articleCategories, self::MOVIES_AC);
			
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::MOVIES_AC, 2);
			$viewParams['moviesArticles'] = $articles;
			
			
			
			//reviews articles
			$viewParams['reviewsCategory'] = $this->getArticleCategory($articleCategories, self::REVIEWS_AC);
				
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::REVIEWS_AC, 2);
			$viewParams['reviewsArticles'] = $articles;
			
			
			
			
			
			//products articles
			$viewParams['productsCategory'] = $this->getArticleCategory($articleCategories, self::PRODUCTS_AC);
			
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::PRODUCTS_AC, 6);
			if(count($articles) > 0) {
				$articlesIds = $articleRepository->getIds($articles);
				$brands = $brandRepository->findItemsByArticles($articlesIds);
				$articles = $articleRepository->assignItems($articles, $brands, 'brands');
			}
			$viewParams['productsArticles'] = $articles;
			
			
			
			//promotions articles
			$viewParams['promotionsCategory'] = $this->getArticleCategory($articleCategories, self::PROMOTIONS_AC);
				
			$articles = $articleRepository->findCategoryItems($entry->getId(), self::PROMOTIONS_AC, 6);
			if(count($articles) > 0) {
				$articlesIds = $articleRepository->getIds($articles);
				$brands = $brandRepository->findItemsByArticles($articlesIds);
				$articles = $articleRepository->assignItems($articles, $brands, 'brands');
			}
			$viewParams['promotionsArticles'] = $articles;
			
			
			
			
			//useful article categories
			$usefulArticleCategories = array();
			
			//$usefulArticleCategories[] = $this->getArticleCategory($articleCategories, self::REVIEWS_AC);
			$usefulArticleCategories[] = $this->getArticleCategory($articleCategories, self::LAW_AC);
			$usefulArticleCategories[] = $this->getArticleCategory($articleCategories, self::HOME_LINKS_AC);
			$usefulArticleCategories[] = $this->getArticleCategory($articleCategories, self::FOREIGN_LINKS_AC);
			
			$viewParams['usefulArticleCategories'] = $usefulArticleCategories;
			
		} else if($entry->getParent() && $entry->getParent()->getPreleaf()) {
			
			$em = $this->doctrine->getManager();
			
			$brandRepository = new BrandRepository($em, $em->getClassMetadata(Brand::class));
			$viewParams['topBrands'] = $brandRepository->findTopItems($entry->getId());
			
			$segmentRepository = new SegmentRepository($em, $em->getClassMetadata(Segment::class));
			$viewParams['segments'] = $segments = $segmentRepository->findTopItems();
			
			
			$viewParams['products'] = array();
			
			$brands = [];
			
			$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
			
			foreach ($segments as $segment) {
					
				$products = $productRepository->findTopItems($entry->getId(), $segment['id']);
				$viewParams['products'][$segment['id']] = $products;
					
				foreach($products as $product) {
					$brands[$product['brandId']] = ['id' => $product['brandId'], 'name' => $product['brandName'],
							'image' => $product['brandImage'], 'mimeType' => $product['brandMimeType'],
							'forcedWidth' => $product['brandForcedWidth'], 'forcedHeight' => $product['brandForcedHeight'], 'vertical' => $product['brandVertical']
					];
				}
			}
			
			$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
			$categories = $categoryRepository->findSubcategories($entry->getId());
			$viewParams['subcategories'] = $categories;
			
			
			$viewParams['subbrands'] = array();
			$viewParams['subproducts'] = array();
			
			foreach ($categories as $category) {
				$viewParams['subbrands'][$category['id']] = array();
				$viewParams['subproducts'][$category['id']] = array();
					
				foreach ($segments as $segment) {
					$products = $productRepository->findTopItems($category['id'], $segment['id']);
					$viewParams['subproducts'][$category['id']][$segment['id']] = $products;
			
					foreach($products as $product) {
						$brands[$product['brandId']] = ['id' => $product['brandId'], 'name' => $product['brandName'],
								'image' => $product['brandImage'], 'mimeType' => $product['brandMimeType'],
								'forcedWidth' => $product['brandForcedWidth'], 'forcedHeight' => $product['brandForcedHeight'], 'vertical' => $product['brandVertical']
						];
					}
				}
			}
			
			$viewParams['brands'] = $brands;
		}
		
		
		if(count($advertLocations) > 0) {
			$advertRepository = new AdvertRepository($em, $em->getClassMetadata(Advert::class));
			
			foreach($advertLocations as $advertLocation) {
				$adverts = $advertRepository->findAdvertItems($advertLocation, $entry->getId());
				$viewParams[Advert::getLocationName($advertLocation)] = $adverts;
				
				if(count($adverts) > 0) {
					$advertsIds = $advertRepository->getIds($adverts);
					$advertRepository->updateAdvertsShowCounts($advertsIds);
				}
			}
		}
		
		
		$viewParams['category'] = $entry;
		
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
	
	
	
	protected function getEntityType() {
		return Category::class;
	}
}