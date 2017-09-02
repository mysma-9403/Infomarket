<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Manager\Entity\Common\Main\CategoryManager as CommonCategoryManager;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

class CategoryManager extends CommonCategoryManager {

	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager) {
		parent::__construct($repository, $paginator, $paramsManager);
		$this->entriesPerPage = 6;
	}
}