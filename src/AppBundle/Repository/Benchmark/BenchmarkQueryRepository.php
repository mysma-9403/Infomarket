<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Main\BenchmarkQuery;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\BenchmarkQueryFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class BenchmarkQueryRepository extends BaseRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.archived';
		$fields[] = 'e.createdAt';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var BenchmarkQueryFilter $filter */
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.createdBy', $filter->getContextUser()));
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName(), true);
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
}
