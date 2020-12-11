<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Assignments\BranchCategoryAssignment;
use AppBundle\Entity\Main\Branch;
use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Assignments\BranchCategoryAssignmentFilter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BranchCategoryAssignmentRepository extends SimpleRepository {

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
