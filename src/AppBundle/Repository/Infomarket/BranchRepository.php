<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Branch;
use AppBundle\Repository\Base\BaseEntityRepository;
use Doctrine\ORM\QueryBuilder;

class BranchRepository extends BaseEntityRepository
{	
	public function findMenuItems() {
		return $this->queryMenuItems()->getScalarResult();
	}
	
	protected function queryMenuItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name, e.color, e.icon');
		$builder->from(Branch::class, 'e');
		
		$expr = $builder->expr();
		
		$where = $expr->orX();
		$where->add($expr->eq('e.infomarket', 1));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Branch::class;
	}
}
