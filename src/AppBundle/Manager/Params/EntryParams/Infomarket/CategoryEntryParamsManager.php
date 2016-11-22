<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Branch;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\BrandFilter;
use AppBundle\Entity\Filter\CategoryFilter;
use AppBundle\Entity\Filter\ProductFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Entity\User;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;

class CategoryEntryParamsManager extends EntryParamsManager {
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$userRepository = $this->doctrine->getRepository(User::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
		$branchRepository = $this->doctrine->getRepository(Branch::class);
		$productRepository = $this->doctrine->getRepository(Product::class);
		
		
		$segmentFilter = new BaseEntityFilter($userRepository);
		$segmentFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
		
		$segments = $segmentRepository->findSelected($segmentFilter);
		$viewParams['segments'] = $segments;
		
		
		$viewParams['brands'] = array();
		$viewParams['products'] = array();
		
		foreach ($segments as $segment) {				
			$productFilter = new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
			$productFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
			$productFilter->setCategories([$entry]);
			$productFilter->setSegments([$segment]);
			
			$products = $productRepository->findSelected($productFilter);	
			$viewParams['products'][$segment->getId()] = $products;
			
// 			$brandFilter = new BrandFilter($userRepository, $categoryRepository, $segmentRepository);
// 			$brandFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
// 			$brandFilter->setCategories([$entry]);
// 			$brandFilter->setSegments([$segment]);
				
// 			$brands = $brandRepository->findSelected($brandFilter);
// 			$viewParams['brands'][$segment->getId()] = $brands;

			$brands = [];
			
			foreach($products as $product) {
				$brands[$product->getBrand()->getId()] = $product->getBrand();
			}
			
			$viewParams['brands'][$segment->getId()] = $brands;
		}
		
		
		$categoryFilter = new CategoryFilter($userRepository, $branchRepository, $categoryRepository);
		$categoryFilter->setParents([$entry]);
		$categoryFilter->setOrderBy('e.orderNumber ASC, e.name ASC');
			
		$categories = $categoryRepository->findSelected($categoryFilter);
		$viewParams['subcategories'] = $categories;
		
		
		$viewParams['subbrands'] = array();
		$viewParams['subproducts'] = array();
		
		foreach ($categories as $category) {
			$viewParams['subbrands'][$category->getId()] = array();
			$viewParams['subproducts'][$category->getId()] = array();
			
			foreach ($segments as $segment) {	
				$productFilter = new ProductFilter($userRepository, $categoryRepository, $brandRepository, $segmentRepository);
				$productFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
				$productFilter->setCategories([$category]);
				$productFilter->setSegments([$segment]);
				
				$products = $productRepository->findSelected($productFilter);
				$viewParams['subproducts'][$category->getId()][$segment->getId()] = $products;
				
// 				$brandFilter = new BrandFilter($userRepository, $categoryRepository, $segmentRepository);
// 				$brandFilter->setPublished(BaseEntityFilter::TRUE_VALUES);
// 				$brandFilter->setCategories([$category]);
// 				$brandFilter->setSegments([$segment]);
					
// 				$brands = $brandRepository->findSelected($brandFilter);
// 				$viewParams['subbrands'][$category->getId()][$segment->getId()] = $brands;

				$brands = [];
				
				foreach($products as $product) {
					$brands[$product->getBrand()->getId()] = $product->getBrand();
				}
					
				$viewParams['subbrands'][$category->getId()][$segment->getId()] = $brands;
			}
		}
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}