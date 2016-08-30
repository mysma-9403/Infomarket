<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Term;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;

class SearchController extends SimpleEntityController
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\HomeController::indexAction()
	 */
	public function indexAction(Request $request)
	{
		return $this->indexActionInternal($request, 1);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Infomarket\Base\BaseEntityController::getShowParams()
	 */
	protected function getIndexParams(Request $request, $page)
	{
		$params = parent::getIndexParams($request, $page);
		
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$articleCategoryRepository = $this->getDoctrine()->getRepository(ArticleCategory::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		$tagRepository = $this->getDoctrine()->getRepository(Tag::class);
		
		$simpleFilter = new SimpleEntityFilter($userRepository);
		$simpleFilter->setAddNameDecorators(true);
		$simpleFilter->initValues($request);
		$simpleFilter->setPublished(SimpleEntityFilter::ALL_VALUES);
		
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$brands = $brandRepository->findSelected($simpleFilter);
		
		$params['brands'] = $brands;
		
		
		
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		$products = $productRepository->findSelected($simpleFilter);
		
		if(count($brands) > 0) {
			$productFilter = new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
			$productFilter->setBrands($brands);
			$products = array_merge($products, $productRepository->findSelected($productFilter));
		}
		
		$params['products'] = $products;
		
		
		
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$articles = $articleRepository->findSelected($simpleFilter);
		
		if(count($brands) > 0) {
			$articleFilter = new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
			$articleFilter->setBrands($brands);
			$articles = array_merge($articles, $articleRepository->findSelected($articleFilter));
		}
		
		$params['articles'] = $articles;
		
		
		
		$termRepository = $this->getDoctrine()->getRepository(Term::class);
		$terms = $termRepository->findSelected($simpleFilter);
		
		$params['terms'] = $terms;
		
		
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
		
		$filter->setPreleaf(SimpleEntityFilter::TRUE_VALUES);
		 
		return $filter;
	}
	
	protected function createNewFilter() {
		$userRepository = $this->getDoctrine()->getRepository(User::class);
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		$filter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
		$filter->setFilterName('simple_filter_');
		$filter->setAddNameDecorators(true);
		$filter->setAddSubnameDecorators(true);
		
		return $filter;
	}
	
	protected function getEntityName()
	{
		return 'search';
	}
	
    protected function getHomeName()
    {
    	return 'infoprodukt';
    }
}
