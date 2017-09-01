<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Filter\Common\BrandCategorySearchFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\Base\EntryParamsManager;
use AppBundle\Repository\Infoprodukt\BrandRepository;
use AppBundle\Repository\Infoprodukt\ProductRepository;
use AppBundle\Repository\Search\Infoprodukt\ArticleSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\BrandSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\ProductSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\TermSearchRepository;
use Symfony\Component\HttpFoundation\Request;

class SearchEntryParamsManager extends EntryParamsManager {
	
	/**
	 *
	 * @var ArticleSearchRepository
	 */
	protected $articleRepository;
	
	/**
	 *
	 * @var BrandSearchRepository
	 */
	protected $brandRepository;
	
	/**
	 *
	 * @var ProductSearchRepository
	 */
	protected $productRepository;
	
	/**
	 *
	 * @var TermSearchRepository
	 */
	protected $termRepository;
	
	public function __construct(EntityManager $em, FilterManager $fm,
			ArticleSearchRepository $articleRepository, BrandSearchRepository $brandRepository,
			ProductSearchRepository $productRepository, TermSearchRepository $termRepository) {
				parent::__construct($em, $fm);
	
				$this->articleRepository = $articleRepository;
				$this->brandRepository = $brandRepository;
				$this->productRepository = $productRepository;
				$this->termRepository = $termRepository;
	}
	
	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$categories = $viewParams['entries'];
		
		$filter = new BrandCategorySearchFilter();
		$filter->initRequestValues($request);
		
		$brands = $this->brandRepository->findItems($filter);
		$articles = $this->articleRepository->findItems($filter);
		$products = $this->productRepository->findItems($filter);
		$terms = $this->termRepository->findItems($filter);
		
		
		if(count($brands) > 0) {
			//TODO should be done by some array utils class
			$brandsIds = $this->brandRepository->getIds($brands);
			
			$filter->setBrands($brandsIds);
			
			if(count($articles) < 8) {
				$articles = array_merge($articles, $this->articleRepository->findItems($filter));
			}
			
			if(count($products) < 8) {
				$products = array_merge($products, $this->productRepository->findItems($filter));
			}
		}
		
		if(count($categories) > 0) {
			//TODO should be done by some array utils class
			$categoriesIds = $this->brandRepository->getIds($categories);
			
			$filter->setCategories($categoriesIds);
			
			if(count($articles) < 8) {
				$articles = array_merge($articles, $this->articleRepository->findItems($filter));
			}
			
			if(count($products) < 8) {
				$products = array_merge($products, $this->productRepository->findItems($filter));
			}
			
			if(count($terms) < 8) {
				$terms = array_merge($terms, $this->termRepository->findItems($filter));
			}
		}
		
		$viewParams['brands'] = $brands;
		$viewParams['articles'] = $articles;
		$viewParams['products'] = $products;
		$viewParams['terms'] = $terms;
		
    	$params['viewParams'] = $viewParams;
    	return $params;
	}
}