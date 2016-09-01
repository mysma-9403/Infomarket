<?php

namespace AppBundle\Repository;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Repository\Base\BaseEntityRepository;

class NewsletterBlockRepository extends BaseEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterBlock::class ;
	}
}
