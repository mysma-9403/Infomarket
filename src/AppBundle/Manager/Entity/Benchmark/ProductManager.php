<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Manager\Entity\Common\ProductManager as CommonProductManager;
use AppBundle\Repository\Benchmark\ProductRepository;

class ProductManager extends CommonProductManager {
	
	/**
	 * 
	 * @var ProductRepository
	 */
	protected $repository;
	
	public function __construct($doctrine, $paginator, ProductRepository $repository) {
		parent::__construct($doctrine, $paginator);
		
		$this->repository = $repository;
		$this->entriesPerPage = 6;
	}
	
	protected function getRepository() {
		return $this->repository;
	}
}