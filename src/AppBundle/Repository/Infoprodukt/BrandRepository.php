<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Brand;
use AppBundle\Repository\Base\BaseEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\BrandCategoryAssignment;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\Category;

class BrandRepository extends BaseEntityRepository
{
	public function findTopItems($category) {
		return $this->queryTopItems($category)->getScalarResult();
	}
	
	public function queryTopItems($category)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.image, e.vertical");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(BrandCategoryAssignment::class, 'bca', Join::WITH, 'e.id = bca.brand');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = bca.category');
		
		$expr = $builder->expr();
		
		$where = $expr->andX();		
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $category . '#%')));
	
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class ;
	}
}
