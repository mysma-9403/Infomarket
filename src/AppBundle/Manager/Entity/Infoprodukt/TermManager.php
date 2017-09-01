<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\Main\TermManager as CommonTermManager;
use AppBundle\Repository\Base\BaseRepository;

class TermManager extends CommonTermManager {

	public function __construct(BaseRepository $repository, $paginator) {
		parent::__construct($repository, $paginator);
		$this->entriesPerPage = 36; // TODO services.yml
	}
}