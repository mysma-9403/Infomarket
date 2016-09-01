<?php

namespace AppBundle\Repository;

use AppBundle\Entity\NewsletterBlockTemplate;
use AppBundle\Repository\Base\BaseEntityRepository;

class NewsletterBlockTemplateRepository extends BaseEntityRepository
{
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterBlockTemplate::class ;
	}
}
