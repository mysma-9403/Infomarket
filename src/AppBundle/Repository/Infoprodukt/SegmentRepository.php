<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Segment;
use AppBundle\Repository\Base\BaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

class SegmentRepository extends BaseEntityRepository
{	
	public function findTopItems() {
		return $this->queryTopItems()->getScalarResult();
	}
	
	protected function queryTopItems() {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select('e.id, e.name, e.subname, e.image, e.mimeType, e.vertical, e.forcedWidth, e.forcedHeight, e.color');
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$builder->where($expr->eq('e.infoprodukt', 1));
		
		$builder->orderBy('e.orderNumber', 'ASC');
		
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Segment::class ;
	}
}
