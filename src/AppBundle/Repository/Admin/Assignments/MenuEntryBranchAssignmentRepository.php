<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Entity\Branch;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class MenuEntryBranchAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'me.id AS menuEntryId';
		$fields[] = 'me.name AS menuEntryName';
	
		$fields[] = 'b.id AS branchId';
		$fields[] = 'b.name AS branchName';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(MenuEntry::class, 'me', Join::WITH, 'me.id = e.menuEntry');
		$builder->innerJoin(Branch::class, 'b', Join::WITH, 'b.id = e.branch');
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var MenuEntryBranchAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getMenuEntries()) > 0) {
			$where->add($builder->expr()->in('e.menuEntry', $filter->getMenuEntries()));
		}
	
		if(count($filter->getBranches()) > 0) {
			$where->add($builder->expr()->in('e.branch', $filter->getBranches()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('me.name', 'ASC');
		$builder->addOrderBy('b.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntryBranchAssignment::class ;
	}
}
