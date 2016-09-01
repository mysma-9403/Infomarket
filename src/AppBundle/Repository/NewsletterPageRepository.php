<?php

namespace AppBundle\Repository;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Repository\Base\BaseEntityRepository;

class NewsletterPageRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterPage::class ;
	}
}
