<?php

namespace AppBundle\Repository\Benchmark\Washer;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Filter\Benchmark\Washer\WasherFilter;
use AppBundle\Repository\Benchmark\ProductRepository;
use Doctrine\ORM\QueryBuilder;

class WasherRepository extends ProductRepository
{	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
	
		//TODO washer fields
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var WasherFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		//TODO washer conditions
	
		return $where;
	}
}
