<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Brand;
use AppBundle\Repository\Base\BaseEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\BrandCategoryAssignment;
use Doctrine\ORM\Query\Expr\Join;

class BrandRepository extends BaseEntityRepository
{	
	public function findTopItems($categoryId) {
		return $this->queryTopItems($categoryId)->getScalarResult();
	}
	
	protected function queryTopItems($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select('e.id, e.name, e.image');
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(BrandCategoryAssignment::class, 'bca', Join::WITH, 'e.id = bca.brand');
		
		$where = $expr->andX();
		$where->add($expr->eq('bca.category', $categoryId));
		$where->add($expr->eq('e.infomarket', 1));
	
		$builder->where($where);
		
		$builder->orderBy('e.name');
	
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class ;
	}
}
