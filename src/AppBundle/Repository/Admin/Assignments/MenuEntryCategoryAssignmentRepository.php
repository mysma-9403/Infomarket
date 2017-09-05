<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Assignments\MenuEntryCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Assignments\MenuEntryCategoryAssignmentFilter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MenuEntryCategoryAssignmentRepository extends SimpleRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'me.id AS menuEntryId';
		$fields[] = 'me.name AS menuEntryName';
		
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(MenuEntry::class, 'me', Join::WITH, 'me.id = e.menuEntry');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var MenuEntryCategoryAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.menuEntry', $filter->getMenuEntries());
		$this->addArrayWhere($builder, $where, 'e.category', $filter->getCategories());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('me.name', 'ASC');
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
	}

	protected function getEntityType() {
		return MenuEntryCategoryAssignment::class;
	}
}
