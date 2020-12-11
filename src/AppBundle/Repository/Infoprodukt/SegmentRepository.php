<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Main\Segment;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class SegmentRepository extends BaseRepository {

	public function findTopItems() {
		return $this->queryTopItems()->getScalarResult();
	}

	protected function queryTopItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select(
				'e.id, e.name, e.subname, e.image, e.mimeType, e.vertical, e.forcedWidth, e.forcedHeight, e.color');
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$builder->where($expr->eq('e.infoprodukt', 1));
		
		$builder->orderBy('e.orderNumber', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Segment::class;
	}
}
