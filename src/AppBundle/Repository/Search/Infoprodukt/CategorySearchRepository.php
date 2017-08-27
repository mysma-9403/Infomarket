<?php

namespace AppBundle\Repository\Search\Infoprodukt;

use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\SearchFilter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\QueryBuilder;

class CategorySearchRepository extends SearchRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.subname';
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var SearchFilter $filter */
		
		$expr = $builder->expr();
		$where->add($expr->eq('e.infoprodukt', 1));
		
		return $where;
	}

	protected function getEntityType() {
		return Category::class;
	}
}
