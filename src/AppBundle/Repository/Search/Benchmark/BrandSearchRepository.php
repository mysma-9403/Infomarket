<?php

namespace AppBundle\Repository\Search\Benchmark;

use AppBundle\Entity\Main\Brand;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\QueryBuilder;

class BrandSearchRepository extends SearchRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		
		return $fields;
	}

	protected function getEntityType() {
		return Brand::class;
	}
}
