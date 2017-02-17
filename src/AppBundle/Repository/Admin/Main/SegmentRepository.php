<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Segment;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;
use Doctrine\ORM\QueryBuilder;

class SegmentRepository extends ImageEntityRepository
{	
	public function findTopItems() {
		return $this->queryTopItems()->getScalarResult();
	}
	
	protected function queryTopItems() {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select('e.id, e.name');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->orderBy('e.orderNumber', 'ASC');
	
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Segment::class;
	}
}
