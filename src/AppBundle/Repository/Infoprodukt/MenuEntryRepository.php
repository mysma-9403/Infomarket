<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Assignments\MenuEntryCategoryAssignment;
use AppBundle\Entity\Assignments\MenuMenuEntryAssignment;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MenuEntryRepository extends BaseRepository {

	public function findMenuItems($menuId, $categories) {
		$items = $this->queryMenuItems($menuId, $categories)->getScalarResult();
		
		$rootItems = $this->getRootItems($items);
		
		$index = 0;
		$size = count($rootItems);
		for ($i = 0; $i < $size; $i ++) {
			$rootItem = $rootItems[$i];
			$rootItems[$i] = $this->assignChildren($rootItem, $items, $index);
		}
		
		return $rootItems;
	}

	protected function queryMenuItems($menuId, $categories) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select(
				"e.id, IDENTITY(e.parent) AS parent, e.name, IDENTITY(e.link) AS link, IDENTITY(e.page) AS page");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(MenuMenuEntryAssignment::class, 'mmea', Join::WITH, 'e.id = mmea.menuEntry');
		if (count($categories) > 0) {
			$builder->innerJoin(MenuEntryCategoryAssignment::class, 'meca', Join::WITH, 'e.id = meca.menuEntry');
		}
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('mmea.menu', $menuId));
		
		if (count($categories) > 0) {
			$where->add($builder->expr()->in('meca.category', $categories));
		}
		
		$builder->where($where);
		
		$builder->orderBy('e.treePath', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return MenuEntry::class;
	}
}
