<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\Main\MagazineManager as CommonMagazineManager;
use AppBundle\Repository\Base\BaseRepository;

class MagazineManager extends CommonMagazineManager {
	
	public function __construct(BaseRepository $repository, $paginator) {
		parent::__construct($repository, $paginator);
		$this->entriesPerPage = 12; //TODO should be initialized in services.yml
	}
}