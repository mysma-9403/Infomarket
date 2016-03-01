<?php

namespace AppBundle\Repository;

use AppBundle\Repository\Base\BaseEntityRepository;
use AppBundle\Entity\Segment;

class SegmentRepository extends BaseEntityRepository
{
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Segment::class ;
	}
}