<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class NewsletterPageTemplateRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterPageTemplate::class;
	}
}
