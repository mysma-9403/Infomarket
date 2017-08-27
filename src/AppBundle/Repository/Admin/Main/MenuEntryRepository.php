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
use AppBundle\Entity\MenuMenuEntryAssignment;

class MenuEntryRepository extends SimpleEntityRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		/** @var MenuEntryFilter $filter */
		
		$builder->leftJoin(Page::class, 'p', Join::WITH, 'p.id = e.page');
		$builder->leftJoin(Link::class, 'l', Join::WITH, 'l.id = e.link');
		
		if (count($filter->getMenus()) > 0) {
			$builder->leftJoin(MenuMenuEntryAssignment::class, 'mmea', Join::WITH, 'e.id = mmea.menuEntry');
		}
		
		if (count($filter->getBranches()) > 0) {
			$builder->leftJoin(MenuEntryBranchAssignment::class, 'meba', Join::WITH, 'e.id = meba.menuEntry');
		}
		
		if (count($filter->getCategories()) > 0) {
			$builder->leftJoin(MenuEntryCategoryAssignment::class, 'meca', Join::WITH, 'e.id = meca.menuEntry');
		}
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		
		$fields[] = 'p.id AS pageId';
		$fields[] = 'p.name AS pageName';
		$fields[] = 'l.id AS linkId';
		$fields[] = 'l.name AS linkName';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var MenuEntryFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		
		$this->addArrayWhere($builder, $where, 'mmea.menu', $filter->getMenus());
		$this->addArrayWhere($builder, $where, 'e.parent', $filter->getParents());
		$this->addArrayWhere($builder, $where, 'meba.branch', $filter->getBranches());
		$this->addArrayWhere($builder, $where, 'meca.category', $filter->getCategories());
		
		return $where;
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		
		return $fields;
	}

	protected function getEntityType() {
		return MenuEntry::class;
	}
}
