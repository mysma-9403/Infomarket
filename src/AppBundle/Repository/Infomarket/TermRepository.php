<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Term;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class TermRepository extends BaseRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.name';
	
		return $fields;
	}

	protected function getEntityType() {
		return Term::class;
	}
}
