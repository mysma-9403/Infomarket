<?php

namespace AppBundle\Repository\Search\Infomarket;

use AppBundle\Filter\Common\SearchFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Category;

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
		$where->add($expr->eq('e.infomarket', 1));
		
		return $where;
	}

	protected function getEntityType() {
		return Category::class;
	}
}
