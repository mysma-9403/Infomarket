<?php

namespace AppBundle\Repository\Applications;

use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends BaseRepository {

	public function findItemsByCategory($categoryId) {
		return $this->queryItemsByCategory($categoryId)->getScalarResult();
	}

	protected function queryItemsByCategory($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("b.name as brandName, e.name, e.image, c.id as category");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.benchmarkQuery'));
		// $where->add($builder->expr()->eq('e.application', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Product::class;
	}
}
