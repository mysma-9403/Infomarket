<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Main\Segment;
use AppBundle\Repository\Admin\Main\SegmentRepository as BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class SegmentRepository extends BaseRepository {

	public function findItemsByCategory($categoryId) {
		return $this->queryItemsByCategory($categoryId)->getScalarResult();
	}

	protected function queryItemsByCategory($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.name, COUNT(pca.product) AS numOfProducts");
		$builder->from($this->getEntityType(), "e");
		
		$builder->leftJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.segment');
		$builder->leftJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
		// $where->add($builder->expr()->eq('e.benchmark', 1));
		$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->groupBy('e.name');
		
		$builder->orderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Segment::class;
	}
}
