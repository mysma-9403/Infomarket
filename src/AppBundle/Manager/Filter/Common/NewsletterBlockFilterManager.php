<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Filter\NewsletterBlockFilter;
use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class NewsletterBlockFilterManager extends BaseEntityFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var NewsletterBlockFilter $filter */
		$filter = parent::adaptToView($filter, $params);
	
		$filter->setOrderBy('e.createdAt DESC');
	
		return $filter;
	}
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$newsletterPageRepository = $this->doctrine->getRepository(NewsletterPage::class);
		$newsletterBlockTemplateRepository = $this->doctrine->getRepository(NewsletterBlockTemplate::class);
    	
    	return new NewsletterBlockFilter($userRepository, $newsletterPageRepository, $newsletterBlockTemplateRepository);
	}
}