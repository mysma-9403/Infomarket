<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryCategoryAssignment;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MenuEntryRepository extends BaseRepository
{	
	public function findMenuItems($menuId, $categoryId) {
		$items = $this->queryMenuItems($menuId, $categoryId)->getScalarResult();
		
		$rootItems = $this->getRootItems($items);
		
		$index = 0;
		$size = count($rootItems);
		for($i = 0; $i < $size; $i++) {
			$rootItem = $rootItems[$i];
			$rootItems[$i] = $this->assignChildren($rootItem, $items, $index);
		}
		
		return $rootItems;
	}
	
	protected function queryMenuItems($menuId, $categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, IDENTITY(e.parent) AS parent, e.name, IDENTITY(e.link) AS link, IDENTITY(e.page) AS page");
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(MenuMenuEntryAssignment::class, 'mmea', Join::WITH, 'e.id = mmea.menuEntry');
		if($categoryId) {
			$builder->innerJoin(MenuEntryCategoryAssignment::class, 'meca', Join::WITH, 'e.id = meca.menuEntry');
		}
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('mmea.menu', $menuId));
		
		if($categoryId) {
			$where->add($builder->expr()->eq('meca.category', $categoryId));
		}
		
		$builder->where($where);
	
		$builder->orderBy('e.treePath', 'ASC');
	
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntry::class ;
	}
}
