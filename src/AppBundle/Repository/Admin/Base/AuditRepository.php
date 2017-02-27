<?php

namespace AppBundle\Repository\Admin\Base;

use AppBundle\Entity\User;
use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

abstract class AuditRepository extends BaseRepository
{
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
		/** @var AuditFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		
		if($filter->getUpdatedAfter()) {
			$where->add($builder->expr()->gt('e.updatedAt', $builder->expr()->literal($filter->getUpdatedAfter())));
		}
		
		if($filter->getUpdatedBefore()) {
			$where->add($builder->expr()->lt('e.updatedAt', $builder->expr()->literal($filter->getUpdatedBefore())));
		}
		
		
		if($filter->getCreatedAfter()) {
			$where->add($builder->expr()->gt('e.createdAt', $builder->expr()->literal($filter->getCreatedAfter())));
		}
		
		if($filter->getCreatedBefore()) {
			$where->add($builder->expr()->lt('e.createdAt', $builder->expr()->literal($filter->getCreatedBefore())));
		}
		
		
		if(count($filter->getCreatedBy()) > 0) {
			$where->add($builder->expr()->in('e.createdBy', $filter->getCreatedBy()));
		}
		
		if(count($filter->getUpdatedBy()) > 0) {
			$where->add($builder->expr()->in('e.updatedBy', $filter->getUpdatedBy()));
		}
		
		return $where;
	}
	
	protected function buildLimit(QueryBuilder &$builder, Filter $filter) { 
		$builder->setMaxResults(8);
	}
}
