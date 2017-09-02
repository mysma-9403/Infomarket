<?php

namespace AppBundle\Manager\Entity\Infomarket;

use AppBundle\Manager\Entity\Common\Main\MagazineManager as CommonMagazineManager;
use AppBundle\Repository\Base\BaseRepository;

class MagazineManager extends CommonMagazineManager {

	public function __construct(BaseRepository $repository, $paginator) {
		parent::__construct($repository, $paginator);
		
		$this->entriesPerPage = 12;
	}
}