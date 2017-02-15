<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Segment;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;

class SegmentRepository extends SimpleEntityRepository
{	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Segment::class;
	}
}
