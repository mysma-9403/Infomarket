<?php

namespace AppBundle\Repository\Admin\Base;

use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;

abstract class ImageRepository extends SimpleRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.image';
		$fields[] = 'e.mimeType';
		$fields[] = 'e.vertical';
		
		return $fields;
	}
}
