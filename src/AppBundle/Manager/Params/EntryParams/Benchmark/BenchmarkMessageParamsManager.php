<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Repository\Benchmark\ProductRepository;

class BenchmarkMessageParamsManager extends EntryParamsManager {
	
	public function getNewParams(Request $request, array $params) {
		$params = parent::getNewParams($request, $params);
		$viewParams = $params['viewParams'];
		
		$productId = $request->get('product');
		if($productId) {
			$em = $this->doctrine->getManager();
			$productRepository = new ProductRepository($em, $em->getClassMetadata(Product::class));
			$product = $productRepository->findItem($productId);
			$viewParams['product'] = $product;
		}
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}