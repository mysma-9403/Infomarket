<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;

class NewsletterPageTemplateFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'newsletter_page_template_filter_';
	}
}