<?php

namespace AppBundle\Repository\Admin\Base;

use AppBundle\Entity\Main\User;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

abstract class SimpleRepository extends BaseRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.createdAt';
		$fields[] = 'e.updatedAt';
		
		$fields[] = 'cu.id AS createdById';
		$fields[] = 'cu.surname AS createdBySurname';
		$fields[] = 'cu.forename AS createdByForename';
		
		$fields[] = 'uu.id AS updatedById';
		$fields[] = 'uu.surname AS updatedBySurname';
		$fields[] = 'uu.forename AS updatedByForename';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		$builder->leftJoin(User::class, 'cu', Join::WITH, 'e.createdBy = cu.id');
		$builder->leftJoin(User::class, 'uu', Join::WITH, 'e.createdBy = uu.id');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var BaseFilter $filter */
		
		$this->addDateAfterWhere($builder, $where, 'e.updatedAt', $filter->getUpdatedAfter());
		$this->addDateBeforeWhere($builder, $where, 'e.updatedAt', $filter->getUpdatedBefore());
		
		$this->addDateAfterWhere($builder, $where, 'e.createdAt', $filter->getCreatedAfter());
		$this->addDateBeforeWhere($builder, $where, 'e.createdAt', $filter->getCreatedBefore());
		
		$this->addArrayWhere($builder, $where, 'e.createdBy', $filter->getCreatedBy());
		$this->addArrayWhere($builder, $where, 'e.updatedBy', $filter->getUpdatedBy());
		
		return $where;
	}

	protected function buildLimit(QueryBuilder &$builder, Filter $filter) {
		$builder->setMaxResults(8);
	}
}
