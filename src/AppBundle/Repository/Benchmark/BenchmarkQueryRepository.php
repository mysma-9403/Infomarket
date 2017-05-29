<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class BenchmarkQueryRepository extends BaseRepository
{	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.createdAt';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		
		$expr = $builder->expr();
		
		/** @var BenchmarkQueryFilter $filter */
		$where->add($expr->in('e.createdBy', $filter->getCreatedBy()));
		if($filter->getName()) {
			$where->add($this->buildStringsExpression($builder, 'e.name', $filter->getName(), true));
		}
		
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
}
