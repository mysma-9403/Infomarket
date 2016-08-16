<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
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
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\BranchFilter;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Filter\TermFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Term;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\SegmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tag;

class CategoryController extends SimpleEntityController
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::indexAction()
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param unknown $id
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getShowParams()
	 */
	protected function getIndexParams(Request $request, $page)
	{
		$params = parent::getIndexParams($request, $page);
	
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		$branchFilter = new BranchFilter($categoryRepository);
		$branchFilter->initValues($request);
		$branchFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
		$branchFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
		
		$branches = $this->getParamList(Branch::class, $branchFilter);
		$params['branches'] = $branches;
		
		$categoryFilter = new CategoryFilter($branchRepository, $categoryRepository);
		$categoryFilter->initValues($request);
		$categoryFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
		$categoryFilter->setPreleaf(SimpleEntityFilter::TRUE_VALUES);
		$categoryFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
		
		$categories = $this->getParamList(Category::class, $categoryFilter);
		$params['categories'] = $categories;
		
		$params['limitCategories'] = count($categoryFilter->getBranches()) == 0;
	
		return $params;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getShowParams()
	 */
	protected function getShowParams(Request $request, $id)
	{
		$params = parent::getShowParams($request, $id);
		
		$entry = $params['entry'];
		
		if($entry->getPreleaf()) {
			$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
			$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
			$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
			$tagRepository = $this->getDoctrine()->getRepository(Tag::class);
			
			$articleFilter = new ArticleFilter($articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
			$articleFilter->setCategories([$entry]);
			$articleFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
			$articleFilter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
			$articleFilter->setMain(SimpleEntityFilter::TRUE_VALUES);
			$articleFilter->setOrderBy('e.publishedAt ASC');
			$articleFilter->setLimit(7);
			
			$articles = $this->getParamList(Article::class, $articleFilter);
			$params['articles'] = $articles;
			
			
			
			$articleCategory = $this->getDoctrine()->getRepository(ArticleCategory::class)->find(1);
			
			$articleFilter->setArticleCategories([$articleCategory]);
			$articleFilter->setLimit(4);
			
			$promotions = $this->getParamList(Article::class, $articleFilter);
			$params['promotions'] = $promotions; 
			
			
			
			$articleCategoryFilter = new ArticleCategoryFilter();
			$articleCategoryFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
			$articleCategoryFilter->setFeatured(SimpleEntityFilter::TRUE_VALUES);
			//TODO $articleCategoryFilter->setOrderBy('e.orderNumber ASC');
			
			$articleCategories = $articleCategoryRepository->findSelected($articleCategoryFilter);
			$params['article_categories'] = $articleCategories;
			
			$advertFilter = new AdvertFilter($categoryRepository);
			$advertFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$advertFilter->setCategories([$entry]);
			
			$advertFilter->setLocations([Advert::FEATURED_LOCATION]);
			
			$featuredAds = $this->getParamList(Advert::class, $advertFilter);
			shuffle($featuredAds);
			$featuredAds = array_slice($featuredAds, 0, 3);
			$params['featuredAds'] = $featuredAds;
			
			
			
			
			$em = $this->getDoctrine()->getManager();
			 
			foreach($featuredAds as $ad) {
				$ad->setShowCount($ad->getShowCount()+1);
				$em->persist($ad);
			}
			$em->flush();
			
		} else {
			//TODO use as setters as they are useless in many cases!!! (like here)
			//TODO @up - not sure - they are needed in initValues! 
			$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
			$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
			$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
			$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
			
			$segments = $segmentRepository->findAll();
			$params['segments'] = $segments;
			
			$params['brands'] = array();
			$params['products'] = array();
			
			foreach ($segments as $segment) {
				$brandFilter = new BrandFilter($categoryRepository, $segmentRepository);
				$brandFilter->setCategories([$entry]);
				$brandFilter->setSegments([$segment]);
				$brandFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
				
				$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
				$brands = $brandRepository->findSelected($brandFilter);
				
				$params['brands'][$segment->getId()] = $brands;
				
				$productFilter = new ProductFilter($categoryRepository, $brandRepository, $segmentRepository);
				$productFilter->setCategories([$entry]);
				$productFilter->setSegments([$segment]);
				$productFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
				
				$productRepository = $this->getDoctrine()->getRepository(Product::class);
				$products = $productRepository->findSelected($productFilter);
				
				$params['products'][$segment->getId()] = $products;
			}
			
			
			
			$params['subbrands'] = array();
			$params['subproducts'] = array();
			
			$categoryFilter = new CategoryFilter($branchRepository, $categoryRepository);
			$categoryFilter->setParents([$entry]);
			$categoryFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
				
			$categories = $categoryRepository->findSelected($categoryFilter);
			$params['subcategories'] = $categories;
			
			foreach ($categories as $category) {
				$params['subbrands'][$category->getId()] = array();
				$params['subproducts'][$category->getId()] = array();
				
				foreach ($segments as $segment) {
					$brandFilter = new BrandFilter($categoryRepository, $segmentRepository);
					$brandFilter->setCategories([$category]);
					$brandFilter->setSegments([$segment]);
					$brandFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
				
					$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
					$brands = $brandRepository->findSelected($brandFilter);
				
					$params['subbrands'][$category->getId()][$segment->getId()] = $brands;
				
					$productFilter = new ProductFilter($categoryRepository, $brandRepository, $segmentRepository);
					$productFilter->setCategories([$category]);
					$productFilter->setSegments([$segment]);
					$productFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
				
					$productRepository = $this->getDoctrine()->getRepository(Product::class);
					$products = $productRepository->findSelected($productFilter);
				
					$params['subproducts'][$category->getId()][$segment->getId()] = $products;
				}
			}
			
			$termFilter = new TermFilter($categoryRepository);
			// 		$termFilter->setCategories([$entry]);
			$termFilter->setPublished(SimpleEntityFilter::TRUE_VALUES);
			$termRepository = $this->getDoctrine()->getRepository(Term::class);
			$terms = $termRepository->findSelected($termFilter);
			
			$params['terms'] = $terms;
		}
		
		return $params;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::getEntityType()
	 */
	protected function getEntityType()
	{
		return Category::class;
	}
	
	protected function getEntityFilter(Request $request)
	{
		$filter = parent::getEntityFilter($request);
		$filter->setOrderBy('e.orderNumber ASC, e.name ASC');
		 
		return $filter;
	}
	
	protected function createNewFilter() {
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		return new CategoryFilter($branchRepository, $categoryRepository);
	}
	
    protected function getHomeName()
    {
    	return 'infoprodukt';
    }
    
    protected function initBranch(Request $request, $branches)
    {
    	return $this->getParamByName($request, Branch::class, null);
    }
    
    protected function showRootCategories()
    {
    	return SimpleEntityFilter::TRUE_VALUES;
    }
    
    protected function showPreleafCategories()
    {
    	return SimpleEntityFilter::ALL_VALUES;
    }
}
