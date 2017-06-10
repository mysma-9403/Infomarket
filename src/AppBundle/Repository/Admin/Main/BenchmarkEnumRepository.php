<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\BenchmarkEnum;
use AppBundle\Filter\Admin\Main\BenchmarkEnumFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;

class BenchmarkEnumRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.name';
		$fields[] = 'e.value';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var BenchmarkEnumFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if($filter->getName()) {
			$where->add($this->buildStringsExpression($builder, 'e.name', $filter->getName()));
		}
		
		return $where;
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return BenchmarkEnum::class;
	}
}