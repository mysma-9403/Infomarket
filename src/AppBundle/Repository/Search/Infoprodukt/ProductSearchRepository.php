<?php

namespace AppBundle\Repository\Search\Infoprodukt;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\BrandCategorySearchFilter;
use AppBundle\Repository\Search\Base\SearchRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Brand;

class ProductSearchRepository extends SearchRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		
		if (count($filter->getCategories()) > 0) {
			$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		}
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
		$where = null;
		
		$expr = $builder->expr();
		
		if (count($filter->getCategories()) > 0) {
			$where = $expr->andX();
			$where->add($expr->in('pca.category', $filter->getCategories()));
		} else if (count($filter->getBrands()) > 0) {
			$where = $expr->andX();
			$where->add($expr->in('e.brand', $filter->getBrands()));
		} else {
			$where = parent::getWhere($builder, $filter);
		}
		
		$where->add($expr->eq('e.infoprodukt', 1));
		
		return $where;
	}

	protected function getEntityType() {
		return Product::class;
	}
}
