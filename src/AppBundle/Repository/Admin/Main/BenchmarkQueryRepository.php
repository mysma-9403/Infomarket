<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\BenchmarkQuery;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;

class BenchmarkQueryRepository extends BaseRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		return $fields;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
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
		return BenchmarkQuery::class;
	}
}
