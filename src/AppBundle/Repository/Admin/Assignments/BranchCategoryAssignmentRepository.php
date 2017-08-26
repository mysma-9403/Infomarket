<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Branch;
use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Admin\Assignments\BranchCategoryAssignmentFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BranchCategoryAssignmentRepository extends AuditRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'b.id AS branchId';
		$fields[] = 'b.name AS branchName';
		
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Branch::class, 'b', Join::WITH, 'b.id = e.branch');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var BranchCategoryAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.branch', $filter->getBranches());
		$this->addArrayWhere($builder, $where, 'e.category', $filter->getCategories());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
	}

	protected function getEntityType() {
		return BranchCategoryAssignment::class;
	}
}
