<?php

namespace AppBundle\Controller\Infoprodukt;

use AppBundle\Controller\Infoprodukt\Base\SimpleEntityController;
use AppBundle\Entity\Article;
use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Filter\TermFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Term;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends SimpleEntityController
{
	/**
	 * 
	 * @param Request $request
	 * @param unknown $page
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
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
		
		
		
		$segmentRepository = $this->getDoctrine()->getRepository(Segment::class);
		$segments = $segmentRepository->findAll();
		
		$params['segments'] = $segments;
		
		
		
		$productRepository = $this->getDoctrine()->getRepository(Product::class);
		$products = $productRepository->findBy(['category' => $entry, 'published' => true]);
		
		$params['products'] = $products;
		
		
		
		$brandFilter = new BrandFilter();
		$brandFilter->setCategories([$entry]);
		$brandFilter->setPublished(true);
		$brandRepository = $this->getDoctrine()->getRepository(Brand::class);
		$brands = $brandRepository->findSelected($brandFilter);
		
		$params['brands'] = $brands;
		
		
		
		$termFilter = new TermFilter();
// 		$termFilter->setCategories([$entry]);
		$termFilter->setPublished(true);
		$termRepository = $this->getDoctrine()->getRepository(Term::class);
		$terms = $termRepository->findSelected($termFilter);
		
		$params['terms'] = $terms;
		
		
		
		$articleFilter = new ArticleFilter();
// 		$articleFilter->setCategories([$entry]);
		$articleFilter->setPublished(true);
		$articleRepository = $this->getDoctrine()->getRepository(Article::class);
		$articles = $articleRepository->findSelected($articleFilter);
		
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
		$filter->setPublished(true);
		
		$category = $this->getParamById($request, Category::class, null);
		
		if($category) {
			$filter->setParents([$category]);
		}
		 
		return $filter;
	}
	
    protected function getEntityName()
    {
    	return 'home';
    }
}
