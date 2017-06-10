<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Manager\Entity\Common\ProductManager as CommonProductManager;

class ProductManager extends CommonProductManager {
	
	//TODO remove $doctrine
	//TODO move $repository to the base class
	protected $repository;
	
	public function __construct($doctrine, $paginator, $repository) {
		parent::__construct($doctrine, $paginator);
		
		$this->repository = $repository;
		$this->entriesPerPage = 6;
	}
	
	protected function getRepository() {
		return $this->repository;
	}
}