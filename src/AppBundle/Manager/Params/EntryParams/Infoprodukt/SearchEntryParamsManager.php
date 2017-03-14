<?php

namespace AppBundle\Manager\Params\EntryParams\Infoprodukt;

use AppBundle\Entity\Article;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Entity\Term;
use AppBundle\Filter\Common\BrandCategorySearchFilter;
use AppBundle\Manager\Params\EntryParams\Infoprodukt\Base\EntryParamsManager;
use AppBundle\Repository\Infoprodukt\BrandRepository;
use AppBundle\Repository\Infoprodukt\ProductRepository;
use AppBundle\Repository\Search\Infoprodukt\ArticleSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\BrandSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\ProductSearchRepository;
use AppBundle\Repository\Search\Infoprodukt\TermSearchRepository;
use Symfony\Component\HttpFoundation\Request;

class SearchEntryParamsManager extends EntryParamsManager {
	
	public function getIndexParams(Request $request, array $params, $page) {
		$params = parent::getIndexParams($request, $params, $page);
		
		$viewParams = $params['viewParams'];
		
		$categories = $viewParams['entries'];
		
		$filter = new BrandCategorySearchFilter();
		$filter->initRequestValues($request);
		
		$em = $this->doctrine->getManager();
		
		$brandRepository = new BrandSearchRepository($em, $em->getClassMetadata(Brand::class));
		$brands = $brandRepository->findItems($filter);
		
		
		$articleRepository = new ArticleSearchRepository($em, $em->getClassMetadata(Article::class));
		$articles = $articleRepository->findItems($filter);
		
		
		$productRepository = new ProductSearchRepository($em, $em->getClassMetadata(Product::class));
		$products = $productRepository->findItems($filter);
		
		
		$termRepository = new TermSearchRepository($em, $em->getClassMetadata(Term::class));
		$terms = $termRepository->findItems($filter);
		
		
		if(count($brands) > 0) {
			//TODO should be done by some array utils class
			$brandsIds = $brandRepository->getIds($brands);
			
			$filter->setBrands($brandsIds);
			
			if(count($articles) < 8) {
				$articles = array_merge($articles, $articleRepository->findItems($filter));
			}
			
			if(count($products) < 8) {
				$products = array_merge($products, $productRepository->findItems($filter));
			}
		}
		
		if(count($categories) > 0) {
			//TODO should be done by some array utils class
			$categoriesIds = $brandRepository->getIds($categories);
			
			$filter->setCategories($categoriesIds);
			
			if(count($articles) < 8) {
				$articles = array_merge($articles, $articleRepository->findItems($filter));
			}
			
			if(count($products) < 8) {
				$products = array_merge($products, $productRepository->findItems($filter));
			}
			
			if(count($terms) < 8) {
				$terms = array_merge($terms, $termRepository->findItems($filter));
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