<?php

namespace AppBundle\Manager\Params\EntryParams\Benchmark;

use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Main\Product;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;

class BenchmarkMessageParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var ProductRepository
	 */
	protected $productRepository;

	public function __construct(EntityManager $em, FilterManager $fm, ProductRepository $productRepository) {
		parent::__construct($em, $fm);
		
		$this->productRepository = $productRepository;
	}

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
		
		if ($entry->getState() == BenchmarkMessage::INFORMATION_REQUIRED_STATE) {
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
		if ($productId) {
			$product = $this->productRepository->findItem($productId);
			$viewParams['product'] = $product;
		}
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}