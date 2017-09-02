<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Filter\Common\Assignments\MenuMenuEntryAssignmentFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MenuMenuEntryAssignmentRepository extends AuditRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'm.id AS menuId';
		$fields[] = 'm.name AS menuName';
		
		$fields[] = 'me.id AS menuEntryId';
		$fields[] = 'me.name AS menuEntryName';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Menu::class, 'm', Join::WITH, 'm.id = e.menu');
		$builder->innerJoin(MenuEntry::class, 'me', Join::WITH, 'me.id = e.menuEntry');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var MenuMenuEntryAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.menu', $filter->getMenus());
		$this->addArrayWhere($builder, $where, 'e.menuEntry', $filter->getMenuEntries());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('m.name', 'ASC');
		$builder->addOrderBy('me.name', 'ASC');
	}

	protected function getEntityType() {
		return MenuMenuEntryAssignment::class;
	}
}
