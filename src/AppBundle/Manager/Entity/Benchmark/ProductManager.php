<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Manager\Entity\Common\Main\ProductManager as CommonProductManager;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

class ProductManager extends CommonProductManager {
	
	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager) {
		parent::__construct($repository, $paginator, $paramsManager);
		$this->entriesPerPage = 6;
	}
}