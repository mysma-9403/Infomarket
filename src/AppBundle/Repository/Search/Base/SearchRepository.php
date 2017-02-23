<?php

namespace AppBundle\Repository\Search\Base;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\SearchFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

abstract class SearchRepository extends BaseRepository
{
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
		/** @var SearchFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if($filter->getString() && strlen($filter->getString()) > 0) {
			$where->add($this->buildStringsExpression($builder, 'e.name', $filter->getString(), true));
		}
		
		return $where; 
	}
}