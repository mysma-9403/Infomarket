<?php

namespace AppBundle\Repository;

use Gedmo\Tree\Entity\Repository\MaterializedPathRepository;
use AppBundle\Repository\Base\BaseEntityRepository;
use AppBundle\Entity\MenuEntry;

class MenuEntryRepository extends BaseEntityRepository// MaterializedPathRepository
{	
	public function findParents()
	{
// 		return $this->queryParents()->getResult();
// 		return $this->childrenHierarchy();
		$repo = $this->getEntityManager()->getRepository($this->getEntityType());
		return $repo->childrenHierarchy();
	}
	
	public function queryParents()
	{
		$query = 'SELECT e ';
		$query .= 'FROM ' . $this->getEntityType() . ' e ';
		$query .= 'WHERE e.parent IS NULL ';
		$query .= 'ORDER BY e.treePath';
		 
		return $this->getEntityManager()->createQuery($query);
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MenuEntry::class ;
	}
}
