<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Segment;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class SegmentRepository extends SimpleEntityRepository
{	
	public function findItemsByCategory($categoryId) {
		return $this->queryItemsByCategory($categoryId)->getScalarResult();
	}
	
	protected function queryItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.name, COUNT(pca.product) AS numOfProducts");
		$builder->from($this->getEntityType(), "e");

		$builder->leftJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.segment');
		$builder->leftJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
// 		$where->add($builder->expr()->eq('e.benchmark', 1));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
		
		$builder->groupBy('e.name');
	
		$builder->orderBy('e.name', 'ASC');
			
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Segment::class;
	}
}
