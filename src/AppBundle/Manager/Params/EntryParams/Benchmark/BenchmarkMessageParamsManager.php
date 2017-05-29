<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Entity\BenchmarkMessage;

class BenchmarkMessageParamsManager extends EntryParamsManager {
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		/** @var BenchmarkMessage $entry */
		$entry = $viewParams['entry'];
		$entry->setReadByAuthor(true);
	
		$newParams = parent::getNewParams($request, $params);
		/** @var BenchmarkMessage $newEntry */
		$newEntry = $newParams['viewParams']['entry'];
	
		$newEntry->setParent($entry);
		$newEntry->setProduct($entry->getProduct());
		$newEntry->setReadByAdmin(false);
		$newEntry->setReadByAuthor(true);
		
		if($entry->getState() == BenchmarkMessage::INFORMATION_REQUIRED_STATE) {
			$newEntry->setState(BenchmarkMessage::INFORMATION_SUPPLIED_STATE);
		} else {
			$newEntry->setState(BenchmarkMessage::REPORTED_STATE);
		}
	
		$viewParams['entry'] = $entry;
		$viewParams['newEntry'] = $newEntry;
	
		$params['viewParams'] = $viewParams;
	
		return $params;
	}
	
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