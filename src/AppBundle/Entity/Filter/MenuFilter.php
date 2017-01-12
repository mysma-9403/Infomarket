<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Repository\UserRepository;

class MenuFilter extends SimpleEntityFilter {

	/**
	 * 
	 * @param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'menu_filter_';
	}
}