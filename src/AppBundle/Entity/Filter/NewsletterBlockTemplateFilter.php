<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;

class NewsletterBlockTemplateFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'newsletter_block_template_filter_';
	}
}