<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\AdvertFilter;
use AppBundle\Entity\Filter\ArticleCategoryFilter;
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
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		
		if($entry->getPreleaf()) {
			$userRepository = $this->doctrine->getRepository(User::class);
			$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
			$categoryRepository = $this->doctrine->getRepository(Category::class);
			$brandRepository = $this->doctrine->getRepository(Brand::class);
			$tagRepository = $this->doctrine->getRepository(Tag::class);
				
			$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
			$articleFilter->setCategories([$entry]);
			$articleFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$articleFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
			$articleFilter->setMain(BaseEntityFilter::TRUE_VALUES);
			$articleFilter->setOrderBy('e.publishedAt ASC');
			$articleFilter->setLimit(7);
				
			$articles = $this->getParamList(Article::class, $articleFilter);
			$viewParams['articles'] = $articles;
				
				
				
			$articleCategory = $this->doctrine->getRepository(ArticleCategory::class)->find(1);
				
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(4);
				
			$promotions = $this->getParamList(Article::class, $articleFilter);
			$viewParams['promotions'] = $promotions;
				
				
				
			$articleCategoryFilter = new ArticleCategoryFilter($userRepository);
			$articleCategoryFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$articleCategoryFilter->setFeatured(BaseEntityFilter::TRUE_VALUES);
			//TODO $articleCategoryFilter->setOrderBy('e.orderNumber ASC');
				
			$articleCategories = $articleCategoryRepository->findSelected($articleCategoryFilter);
			$viewParams['article_categories'] = $articleCategories;
				
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