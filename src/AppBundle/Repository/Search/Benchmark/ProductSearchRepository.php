<?php

namespace AppBundle\Repository\Search\Benchmark;

use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Search\BrandCategorySearchFilter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Category;

class ProductSearchRepository extends SearchRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'pca.product = e.id');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		$fields[] = 'b.name AS brandName';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var BrandCategorySearchFilter $filter */
		$expr = $builder->expr();
		
		$where = $expr->andX();
		
		$where->add($expr->eq('e.benchmark', 1));
		$where->add($expr->eq('c.inProgress', 0));
		
		if (count($filter->getCategories()) > 0) {
			$where->add($expr->in('pca.category', $filter->getCategories()));
		}
		
		if (count($filter->getBrands()) > 0) {
			$where->add($expr->in('e.brand', $filter->getBrands()));
		} else {
			$this->addConcatStringWhere($builder, $where, ['b.name', 'e.name'], $filter->getString(), true);
		}
		
		return $where;
	}

	protected function getEntityType() {
		return Product::class;
	}
}
