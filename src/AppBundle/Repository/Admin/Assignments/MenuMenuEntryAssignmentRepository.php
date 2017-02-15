<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Entity\MenuEntry;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class MenuMenuEntryAssignmentRepository extends AuditRepository
{
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
		
		$builder->leftJoin(Menu::class, 'm', Join::WITH, 'm.id = e.menu');
		$builder->leftJoin(MenuEntry::class, 'me', Join::WITH, 'me.id = e.menuEntry');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('m.name', 'ASC');
		$builder->addOrderBy('me.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuMenuEntryAssignment::class ;
	}
}
