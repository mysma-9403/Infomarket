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
		
		
		
		$simpleFilter = new SimpleEntityFilter();
		$simpleFilter->initValues($request);
		$simpleFilter->setPublished(true);
		
		
		
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		$products = $productRepository->findSelected($simpleFilter);
		
		$params['products'] = $products;
		
		
		
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$brands = $brandRepository->findSelected($simpleFilter);
		
		$params['brands'] = $brands;
		
		
		
		$termRepository = $this->getDoctrine()->getRepository(Term::class);
		$terms = $termRepository->findSelected($simpleFilter);
		
		$params['terms'] = $terms;
		
		
		
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$articles = $articleRepository->findSelected($simpleFilter);
		
		$params['articles'] = $articles;
		
		
		
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
		$branchRepository = $this->getDoctrine()->getRepository(Branch::class);
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		
		$filter = new CategoryFilter($branchRepository, $categoryRepository);
		$filter->initValues($request);
		$filter->setPublished(true);
		$filter->setPreleaf(true);
		 
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
