<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Brand;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Product;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Category;

class BrandRepository extends ImageEntityRepository
{	
	public function findFilterItemsByCategory($categoryId) {
		$items = $this->queryFilterItemsByCategory($categoryId)->getScalarResult();
		return $this->getFilterItems($items);
	}
	
	protected function queryFilterItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name");
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(Product::class, 'p', Join::WITH, 'e.id = p.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'p.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
// 		$where->add($builder->expr()->eq('e.benchmark', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $categoryId . '#%')));
	
		$builder->where($where);
	
		$builder->orderBy('e.name', 'ASC');
			
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class;
	}
}
