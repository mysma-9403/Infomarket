<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Common\Main\BenchmarkFieldFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BenchmarkFieldRepository extends SimpleRepository {

	public function findItemsByCategory($categoryId) {
		return $this->queryItemsByCategory($categoryId)->getScalarResult();
	}

	protected function queryItemsByCategory($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.valueNumber, e.fieldType, e.fieldName, e.decimalPlaces");
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.category', $categoryId ? $categoryId : - 1)); // TODO shouldn't be here I think
		
		$builder->where($where);
		
		$builder->orderBy('e.fieldNumber', 'ASC');
		
		return $builder->getQuery();
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var BenchmarkFieldFilter $filter */
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
		$builder->addOrderBy('e.fieldType', 'ASC');
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
		$fields[] = 'e.decimalPlaces';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var BenchmarkFieldFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		$this->addStringWhere($builder, $where, 'e.fieldName', $filter->getFieldName());
		
		$this->addArrayWhere($builder, $where, 'e.category', $filter->getCategories());
		$this->addArrayWhere($builder, $where, 'e.fieldType', $filter->getFieldTypes());
		
		return $where;
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		
		return $fields;
	}

	protected function getEntityType() {
		return BenchmarkField::class;
	}
}
