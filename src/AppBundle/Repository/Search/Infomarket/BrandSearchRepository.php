<?php

namespace AppBundle\Repository\Search\Infomarket;

use AppBundle\Entity\Brand;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Search\SearchFilter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\QueryBuilder;

class BrandSearchRepository extends SearchRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
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
		return Brand::class;
	}
}
