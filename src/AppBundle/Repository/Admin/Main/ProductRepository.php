<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends ImageEntityRepository
{	
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		parent::buildJoins($builder, $filter);
	
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		
		if(count($filter->getCategories()) > 0) {
			$builder->leftJoin(ProductCategoryAssignment::class, 'mca', Join::WITH, 'e.id = mca.product');
		}
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
	
		parent::buildOrderBy($builder, $filter);
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if(count($filter->getBrands()) > 0) {
			$where->add($builder->expr()->in('e.brand', $filter->getBrands()));
		}
	
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('mca.category', $filter->getCategories()));
		}
	
		return $where;
	}
	
	
	
	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		$builder->addOrderBy('b.name', 'ASC');
		
		parent::buildFilterOrderBy($builder);
	}
	
	protected function buildFilterJoins(QueryBuilder &$builder) { 
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	}
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'b.name AS brandName';
		
		return $fields;
	}
	
	
	protected function getFilterItemKeyFields($item) {
		return [$item['id'], $item['brandName'], $item['name']];
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Product::class;
	}
}