<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Assignments\MenuEntryBranchAssignment;
use AppBundle\Entity\Assignments\MenuMenuEntryAssignment;
use AppBundle\Entity\Main\Branch;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MenuEntryRepository extends BaseRepository {

	public function findMenuItems($menuId, $branchId) {
		$items = $this->queryMenuItems($menuId, $branchId)->getScalarResult();
		
		$rootItems = $this->getRootItems($items);
		
		$index = 0;
		$size = count($rootItems);
		for ($i = 0; $i < $size; $i ++) {
			$rootItem = $rootItems[$i];
			$rootItems[$i] = $this->assignChildren($rootItem, $items, $index);
		}
		
		return $rootItems;
	}

	protected function queryMenuItems($menuId, $branchId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select(
				"e.id, IDENTITY(e.parent) AS parent, e.name, IDENTITY(e.link) AS link, IDENTITY(e.page) AS page");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(MenuMenuEntryAssignment::class, 'mmea', Join::WITH, 'e.id = mmea.menuEntry');
		$builder->innerJoin(MenuEntryBranchAssignment::class, 'meba', Join::WITH, 'e.id = meba.menuEntry');
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infomarket', 1));
		$where->add($builder->expr()->eq('mmea.menu', $menuId));
		$where->add($builder->expr()->eq('meba.branch', $branchId));
		
		$builder->where($where);
		
		$builder->orderBy('e.treePath', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return MenuEntry::class;
	}
}
