<?php

namespace AppBundle\Repository\Applications;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BrandRepository extends BaseRepository {

	public function findItemsByCategory($categoryId) {
		return $this->queryItemsByCategory($categoryId)->getScalarResult();
	}

	protected function queryItemsByCategory($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.name, e.image, e.content, c.id AS category");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(Product::class, 'p', Join::WITH, 'e.id = p.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'p.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
		// $where->add($builder->expr()->eq('e.application', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->orderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	protected function getEntityType() {
		return Brand::class;
	}
}
