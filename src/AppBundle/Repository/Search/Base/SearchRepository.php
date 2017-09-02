<?php

namespace AppBundle\Repository\Search\Base;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Search\SearchFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

abstract class SearchRepository extends BaseRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function buildLimit(QueryBuilder &$builder, Filter $filter) {
		$builder->setMaxResults(13);
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var SearchFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getString(), true);
		
		return $where;
	}
}
