<?php

namespace AppBundle\Repository\Admin\Main;

use Doctrine\ORM\QueryBuilder;

class ParentMagazineRepository extends MagazineRepository {

	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$where->add('e.parent IS NULL');
		
		return $where;
	}
}
