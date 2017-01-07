<?php

namespace AppBundle\Manager\Filter\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\User;

class BaseEntityFilterManager extends FilterManager {
	
	protected $doctrine;
	
	public function __construct($doctrine) {
		$this->doctrine = $doctrine;
	}
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		
		return new BaseEntityFilter($userRepository);
	}
}