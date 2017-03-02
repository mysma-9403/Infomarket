<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;

class BenchmarkFieldRepository extends AuditRepository
{	
	public function findShowItemsByCategory($categoryId) {
		return $this->queryShowItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryShowItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.valueType, e.valueNumber, e.fieldType, e.fieldName");
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.category', $categoryId));
		$where->add($expr->eq('e.showField', 1));
	
		$builder->where($where);
	
		$builder->orderBy('e.fieldNumber', 'ASC');
			
		return $builder->getQuery();
	}
	
	public function findFilterItemsByCategory($categoryId) {
		return $this->queryFilterItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryFilterItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.valueType, e.valueNumber, e.filterType, e.filterName");
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('e.category', $categoryId));
		$where->add($expr->eq('e.showFilter', 1));
	
		$builder->where($where);
	
		$builder->orderBy('e.filterNumber', 'ASC');
			
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return BenchmarkField::class;
	}
}
