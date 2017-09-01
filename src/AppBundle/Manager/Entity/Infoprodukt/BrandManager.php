<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\Main\BrandManager as CommonBrandManager;
use AppBundle\Repository\Base\BaseRepository;

class BrandManager extends CommonBrandManager {
	
	public function __construct(BaseRepository $repository, $paginator) {
		parent::__construct($repository, $paginator);
		$this->entriesPerPage = 12;
	}
}