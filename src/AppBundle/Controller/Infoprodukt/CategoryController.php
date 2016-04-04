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
use AppBundle\Entity\Filter\BranchFilter;

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
	
		$branchFilter = new BranchFilter();
		$branchFilter->initValues($request);
		$branchFilter->setPublished(true);
		 
		$branches = $this->getParamList(Branch::class, $branchFilter);
		$params['branches'] = $branches;
	
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
    	return false;
    }
    
    protected function showPreleafCategories()
    {
    	return true;
    }
}
