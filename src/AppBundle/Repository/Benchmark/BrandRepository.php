<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Repository\Admin\Main\BrandRepository as BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BrandRepository extends BaseRepository {

	public function findFilterItemsByCategory($categoryId) {
		$items = $this->queryFilterItemsByCategory($categoryId)->getScalarResult();
		return $this->getFilterItems($items);
	}

	protected function queryFilterItemsByCategory($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(Product::class, 'p', Join::WITH, 'e.id = p.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'p.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
		// $where->add($builder->expr()->eq('e.benchmark', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->orderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}
}
