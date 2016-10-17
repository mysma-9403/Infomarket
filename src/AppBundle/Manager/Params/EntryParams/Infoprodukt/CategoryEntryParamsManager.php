<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Filter\TermFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Tag;
use AppBundle\Entity\Term;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
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
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		
		if($entry->getPreleaf()) {
			$userRepository = $this->doctrine->getRepository(User::class);
			$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
			$categoryRepository = $this->doctrine->getRepository(Category::class);
			$brandRepository = $this->doctrine->getRepository(Brand::class);
			$branchRepository = $this->doctrine->getRepository(Branch::class);
			$segmentRepository = $this->doctrine->getRepository(Segment::class);
			$tagRepository = $this->doctrine->getRepository(Tag::class);
			
			
			
			$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
			$articleFilter->setCategories([$entry]);
			$articleFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$articleFilter->setMain(BaseEntityFilter::TRUE_VALUES);
			$articleFilter->setOrderBy('e.publishedAt ASC');
			
			
			
			//main articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::MAIN_AC);
			$viewParams['mainCategory'] = $articleCategory;
			
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(10);
				
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['mainArticles'] = $articles;
			
			
			
			//auxiliary articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::AUXILIARY_AC);
			$viewParams['auxiliaryCategory'] = $articleCategory;
			
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
				
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['auxiliaryArticles'] = $articles;
			
			
			
			//questions articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::QUESTIONS_AC);
			$viewParams['questionsCategory'] = $articleCategory;
				
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
			
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['questionsArticles'] = $articles;
			
			
			
			//builds articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::BUILDS_AC);
			$viewParams['buildsCategory'] = $articleCategory;
				
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
			
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['buildsArticles'] = $articles;
			
			
			
			//schemas articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::SCHEMAS_AC);
			$viewParams['schemasCategory'] = $articleCategory;
			
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
				
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['schemasArticles'] = $articles;
			
			
			
			//movies articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::MOVIES_AC);
			$viewParams['moviesCategory'] = $articleCategory;
				
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
			
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['moviesArticles'] = $articles;
			
			
			
			//reviews articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::REVIEWS_AC);
			$viewParams['reviewsCategory'] = $articleCategory;
				
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
			
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['reviewsArticles'] = $articles;
			
			
			
			//products articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::PRODUCTS_AC);
			$viewParams['productsCategory'] = $articleCategory;
				
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
			
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['productsArticles'] = $articles;
			
			
			
			//promotions articles
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(self::PROMOTIONS_AC);
			$viewParams['promotionsCategory'] = $articleCategory;
			
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(6);
				
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['promotionsArticles'] = $articles;
			
			
			
			//brands
			$categories = [$entry];
			
			$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
			$categoryFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
			
			$categoryFilter->setParents([$entry]);
			$subcategories = $categoryRepository->findSelected($categoryFilter);
			$categories = array_merge($categories, $subcategories);
			
			$categoryFilter->setParents($subcategories);
			$subcategories = $categoryRepository->findSelected($categoryFilter);
			$categories = array_merge($categories, $subcategories);
			
			$brandFilter = new BrandFilter($userRepository, $categoryRepository, $segmentRepository);
			$brandFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$brandFilter->setCategories($categories);
			$brandFilter->setLimit(6);
			
			$brands = $this->getParamList(Brand::class, $brandFilter);
			$viewParams['brands'] = $brands;
			
			
			
			//adverts	
			$advertFilter = new AdvertFilter($userRepository, $categoryRepository);
			$advertFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$advertFilter->setActive(BaseEntityFilter::TRUE_VALUES);
			$advertFilter->setCategories([$entry]);
				
			$advertFilter->setLocations([Advert::FEATURED_LOCATION]);
				
			$featuredAds = $this->getParamList(Advert::class, $advertFilter);
			shuffle($featuredAds);
			$featuredAds = array_slice($featuredAds, 0, 3);
			$viewParams['featuredAds'] = $featuredAds;
				
				
				
				
			$em = $this->doctrine->getManager();
		
			foreach($featuredAds as $ad) {
				$ad->setShowCount($ad->getShowCount()+1);
				$em->persist($ad);
			}
			$em->flush();
				
		} else {
			//TODO use as setters as they are useless in many cases!!! (like here)
			//TODO @up - not sure - they are needed in initValues!
			$userRepository = $this->doctrine->getRepository(User::class);
			$categoryRepository = $this->doctrine->getRepository(Category::class);
			$brandRepository = $this->doctrine->getRepository(Brand::class);
			$segmentRepository = $this->doctrine->getRepository(Segment::class);
			$branchRepository = $this->doctrine->getRepository(Branch::class);
				
			$segments = $segmentRepository->findAll();
			$viewParams['segments'] = $segments;
				
			$viewParams['brands'] = array();
			$viewParams['products'] = array();
				
			foreach ($segments as $segment) {
				$brandFilter = new BrandFilter($userRepository, $categoryRepository, $segmentRepository);
				$brandFilter->setCategories([$entry]);
				$brandFilter->setSegments([$segment]);
				$brandFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		
				$brandRepository = $this->doctrine->getRepository(Brand::class);
				$brands = $brandRepository->findSelected($brandFilter);
		
				$viewParams['brands'][$segment->getId()] = $brands;
		
				$productFilter = new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
				$productFilter->setCategories([$entry]);
				$productFilter->setSegments([$segment]);
				$productFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		
				$productRepository = $this->doctrine->getRepository(Product::class);
				$products = $productRepository->findSelected($productFilter);
		
				$viewParams['products'][$segment->getId()] = $products;
			}
				
				
				
			$viewParams['subbrands'] = array();
			$viewParams['subproducts'] = array();
				
			$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
			$categoryFilter->setParents([$entry]);
			$categoryFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
		
			$categories = $categoryRepository->findSelected($categoryFilter);
			$viewParams['subcategories'] = $categories;
				
			foreach ($categories as $category) {
				$viewParams['subbrands'][$category->getId()] = array();
				$viewParams['subproducts'][$category->getId()] = array();
		
				foreach ($segments as $segment) {
					$brandFilter = new BrandFilter($userRepository, $categoryRepository, $segmentRepository);
					$brandFilter->setCategories([$category]);
					$brandFilter->setSegments([$segment]);
					$brandFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		
					$brandRepository = $this->doctrine->getRepository(Brand::class);
					$brands = $brandRepository->findSelected($brandFilter);
		
					$viewParams['subbrands'][$category->getId()][$segment->getId()] = $brands;
		
					$productFilter = new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
					$productFilter->setCategories([$category]);
					$productFilter->setSegments([$segment]);
					$productFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		
					$productRepository = $this->doctrine->getRepository(Product::class);
					$products = $productRepository->findSelected($productFilter);
		
					$viewParams['subproducts'][$category->getId()][$segment->getId()] = $products;
				}
			}
				
			$termFilter = new TermFilter($userRepository, $categoryRepository);
			// 		$termFilter->setCategories([$entry]);
			$termFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$termRepository = $this->doctrine->getRepository(Term::class);
			$terms = $termRepository->findSelected($termFilter);
				
			$params['terms'] = $terms;
		}
		
		$viewParams['category'] = $entry;
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
	
	protected function getEntityType() {
		return Category::class;
	}
}