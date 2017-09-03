<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Assignments\MagazineBranchAssignment;
use AppBundle\Entity\Main\Branch;
use AppBundle\Entity\Main\Magazine;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MagazineBranchAssignmentRepository extends SimpleRepository {

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
		$where = parent::getWhere($builder, $filter);
		/** @var MagazineBranchAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.magazine', $filter->getMagazines());
		$this->addArrayWhere($builder, $where, 'e.branch', $filter->getBranches());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('m.name', 'ASC');
		$builder->addOrderBy('b.name', 'ASC');
	}

	protected function getEntityType() {
		return MagazineBranchAssignment::class;
	}
}
