<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Filter\Admin\Assignments\MenuEntryCategoryAssignmentFilter;

class MenuEntryCategoryAssignmentRepository extends AuditRepository
{
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
		/** @var MenuEntryCategoryAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getMenuEntries()) > 0) {
			$where->add($builder->expr()->in('e.menuEntry', $filter->getMenuEntries()));
		}
	
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('e.category', $filter->getCategories()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('me.name', 'ASC');
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntryCategoryAssignment::class ;
	}
}
