<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;

class NewsletterGroupManager extends SimpleEntityManager {
	
	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}