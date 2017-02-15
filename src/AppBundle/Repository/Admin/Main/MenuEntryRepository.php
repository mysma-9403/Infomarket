<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\MenuEntry;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use AppBundle\Filter\Base\Filter;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Entity\MenuEntryCategoryAssignment;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Filter\Admin\Main\MenuEntryFilter;
use AppBundle\Entity\Page;
use AppBundle\Entity\Link;
use Doctrine\ORM\QueryBuilder;

class MenuEntryRepository extends SimpleEntityRepository
{	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var MenuEntryFilter $filter */
		parent::buildJoins($builder, $filter);
	
		$builder->leftJoin(Page::class, 'p', Join::WITH, 'p.id = e.page');
		$builder->leftJoin(Link::class, 'l', Join::WITH, 'l.id = e.link');
		
		if(count($filter->getMenus()) > 0) {
			$builder->leftJoin(MenuEntryBranchAssignment::class, 'mmea', Join::WITH, 'e.id = mmea.menuEntry');
		}
		
		if(count($filter->getBranches()) > 0) {
			$builder->leftJoin(MenuEntryBranchAssignment::class, 'meba', Join::WITH, 'e.id = meba.menuEntry');
		}
	
		if(count($filter->getCategories()) > 0) {
			$builder->leftJoin(MenuEntryCategoryAssignment::class, 'meca', Join::WITH, 'e.id = meca.menuEntry');
		}
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'p.id AS pageId';
		$fields[] = 'p.name AS pageName';
		$fields[] = 'l.id AS linkId';
		$fields[] = 'l.name AS linkName';
		
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var MenuEntryFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getMenus()) > 0) {
			$where->add($builder->expr()->in('mmea.menu', $filter->getMenus()));
		}
		
		if(count($filter->getParents()) > 0) {
			$where->add($builder->expr()->in('e.parent', $filter->getParents()));
		}
	
		if(count($filter->getBranches()) > 0) {
			$where->add($builder->expr()->in('meba.branch', $filter->getBranches()));
		}
	
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('meca.category', $filter->getCategories()));
		}
	
		return $where;
	}
	
	
	
	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
	
		$where->add('e.parent IS NULL');
	
		return $where;
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntry::class;
	}
}
