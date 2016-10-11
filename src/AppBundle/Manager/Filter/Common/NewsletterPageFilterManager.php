<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\NewsletterPageFilter;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;

class NewsletterPageFilterManager extends BaseFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var NewsletterPageFilter $filter */
		$filter = parent::adaptToView($filter, $params);
	
		$filter->setOrderBy('e.createdAt DESC');
	
		return $filter;
	}
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$newsletterPageTemplateRepository = $this->doctrine->getRepository(NewsletterPageTemplate::class);
    	
    	return new NewsletterPageFilter($userRepository, $newsletterPageTemplateRepository);
	}
}