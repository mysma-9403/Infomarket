<?php

namespace AppBundle\Manager\Params\EntryParams\Infomarket;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Manager\Params\EntryParams\Infomarket\Base\EntryParamsManager;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Repository\Infomarket\CategoryRepository;
use AppBundle\Repository\Infomarket\ProductRepository;
use AppBundle\Repository\Infomarket\SegmentRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryEntryParamsManager extends EntryParamsManager {
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
		
		$em = $this->doctrine->getManager();
		
		$brandRepository = new BrandRepository($em, $em->getClassMetadata(Brand::class));
		$viewParams['topBrands'] = $brandRepository->findTopItems($entry->getId());
		$viewParams['brands'] = $brandRepository->findRecommendedItems($entry->getId());
		
		
		$segmentRepository = new SegmentRepository($em, $em->getClassMetadata(Segment::class));
		$viewParams['segments'] = $segments = $segmentRepository->findTopItems();
		
		
		$viewParams['products'] = array();
		$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
		
		foreach ($segments as $segment) {				
			$products = $productRepository->findTopItems($entry->getId(), $segment['id']);
			$viewParams['products'][$segment['id']] = $products;
		}
		
		$categoryRepository = new CategoryRepository($em, $em->getClassMetadata(Category::class));
		$categories = $categoryRepository->findSubcategories($entry->getId());
		$viewParams['subcategories'] = $categories;
		
		
		$viewParams['subproducts'] = array();
		
		foreach ($categories as $category) {
			$viewParams['subproducts'][$category['id']] = array();
			
			foreach ($segments as $segment) {
				$products = $productRepository->findTopItems($category['id'], $segment['id']);
				$viewParams['subproducts'][$category['id']][$segment['id']] = $products;
			}
		}
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}