<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class NewsletterBlockTemplateRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterBlockTemplate::class;
	}
}
