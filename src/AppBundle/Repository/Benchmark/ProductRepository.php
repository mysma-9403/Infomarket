<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Category;

class ProductRepository extends BaseRepository
{
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.name';
		$fields[] = 'e.image';
		$fields[] = 'e.mimeType';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getBrands()) > 0) {
			$where->add($builder->expr()->in('e.brand', $filter->getBrands()));
		}
	
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('pca.category', $filter->getCategories()));
		} else {
			$where->add($builder->expr()->like('c.treePath', $builder->expr()->literal('%-' . $filter->getContextCategory() . '#%')));
		}
	
		return $where;
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Product::class ;
	}
}
