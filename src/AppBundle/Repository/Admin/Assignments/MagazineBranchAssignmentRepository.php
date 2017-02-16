<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Entity\Branch;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class MagazineBranchAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'm.id AS magazineId';
		$fields[] = 'm.name AS magazineName';
	
		$fields[] = 'b.id AS branchId';
		$fields[] = 'b.name AS branchName';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Magazine::class, 'm', Join::WITH, 'm.id = e.magazine');
		$builder->innerJoin(Branch::class, 'b', Join::WITH, 'b.id = e.branch');
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var MagazineBranchAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getMagazines()) > 0) {
			$where->add($builder->expr()->in('e.magazine', $filter->getMagazines()));
		}
	
		if(count($filter->getBranches()) > 0) {
			$where->add($builder->expr()->in('e.branch', $filter->getBranches()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('m.name', 'ASC');
		$builder->addOrderBy('b.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MagazineBranchAssignment::class ;
	}
}
