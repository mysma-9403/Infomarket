<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterGroupManager extends BaseEntityManager {

	public function createFromRequest(Request $request) {
		/** @var SimpleEntity $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setName($request->get('name'));
		
		return $entry;
	}

	public function createFromTemplate($template) {
		/** @var SimpleEntity $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setName($template->getName());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}