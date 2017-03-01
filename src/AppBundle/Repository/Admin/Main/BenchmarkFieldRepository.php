<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Filter\Admin\Main\BenchmarkFieldFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BenchmarkFieldRepository extends AuditRepository
{	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var BenchmarkFieldFilter $filter */
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
		$builder->addOrderBy('e.valueType', 'ASC');
		$builder->addOrderBy('e.valueNumber', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		$fields[] = 'e.fieldName';
		$fields[] = 'e.fieldType';
		$fields[] = 'e.valueNumber';
		$fields[] = 'e.showField';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var BenchmarkFieldFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('e.category', $filter->getCategories()));
		}
		
		if(count($filter->getFieldTypes()) > 0) {
			$where->add($builder->expr()->in('e.fieldType', $filter->getFieldTypes()));
		}
		
		if($filter->getFieldName()) {
			$where->add($this->buildStringsExpression($builder, 'e.fieldName', $filter->getFieldName()));
		}
	
		return $where;
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return BenchmarkField::class;
	}
}