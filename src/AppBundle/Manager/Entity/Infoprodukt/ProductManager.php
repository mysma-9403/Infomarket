<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\Main\ProductManager as CommonProductManager;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Base\BaseRepository;

class ProductManager extends CommonProductManager {

	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager) {
		parent::__construct($repository, $paginator, $paramsManager);
		$this->entriesPerPage = 12; // TODO same here -> services.yml
	}
}