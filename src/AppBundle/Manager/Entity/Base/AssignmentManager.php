<?php

namespace AppBundle\Manager\Entity\Base;

use AppBundle\Manager\Entity\Base\EntityManager;

use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Base\BaseRepository;

abstract class AssignmentManager extends EntityManager {
	
	/**
	 *
	 * @var ParamsManager
	 */
	protected $paramsManager;
	
	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager) {
		parent::__construct($repository, $paginator);
	
		$this->paramsManager = $paramsManager;
	}
}