<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Main\Branch;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class BranchRepository extends BaseRepository {

	public function findMenuItems() {
		return $this->queryMenuItems()->getScalarResult();
	}

	protected function queryMenuItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name, e.color, e.activeColor, e.icon');
		$builder->from(Branch::class, 'e');
		
		$expr = $builder->expr();
		
		$where = $expr->orX();
		$where->add($expr->eq('e.infomarket', 1));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Branch::class;
	}
}
