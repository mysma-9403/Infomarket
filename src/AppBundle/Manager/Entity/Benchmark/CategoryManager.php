<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Manager\Entity\Common\CategoryManager as CommonCategoryManager;
use AppBundle\Repository\Benchmark\CategoryRepository;

class CategoryManager extends CommonCategoryManager {
	
	/**
	 * 
	 * @var CategoryRepository
	 */
	protected $repository;
	
	public function __construct($doctrine, $paginator, CategoryRepository $repository) {
		parent::__construct($doctrine, $paginator);
		
		$this->repository = $repository;
		$this->entriesPerPage = 6;
	}
	
	protected function getRepository() {
		return $this->repository;
	}
}