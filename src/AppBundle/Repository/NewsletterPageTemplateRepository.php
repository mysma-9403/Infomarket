<?php

namespace AppBundle\Repository;

use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Repository\Base\BaseEntityRepository;

class NewsletterPageTemplateRepository extends BaseEntityRepository
{
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterPageTemplate::class ;
	}
}
