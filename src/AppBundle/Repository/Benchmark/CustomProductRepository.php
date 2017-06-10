<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class CustomProductRepository extends SimpleEntityRepository
{
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		/** @var ProductFilter $filter */
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	
		$builder->leftJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		$builder->leftJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var ProductFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.image';
		$fields[] = 'e.mimeType';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		
		$fields[] = 'e.price';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var CustomProductFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.custom', 1));
		$where->add($expr->eq('e.createdBy', $filter->getContextUser()));
		
		if(count($filter->getBrands()) > 0) {
			$where->add($expr->in('e.brand', $filter->getBrands()));
		}
	
		if(count($filter->getCategories()) > 0) {
			$where->add($expr->in('pca.category', $filter->getCategories()));
		}
		
		if($filter->getName()) {
			$where->add($this->buildStringsExpression($builder, 'e.name', $filter->getName(), true));
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
