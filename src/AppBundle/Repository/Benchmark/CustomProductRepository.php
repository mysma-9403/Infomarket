<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\CustomProductFilter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class CustomProductRepository extends BaseRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
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
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
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
		$where = parent::getWhere($builder, $filter);
		/** @var CustomProductFilter $filter */
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.custom', 1));
		$where->add($expr->eq('e.createdBy', $filter->getContextUser()));
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName(), true);
		
		$this->addArrayWhere($builder, $where, 'e.brand', $filter->getBrands());
		$this->addArrayWhere($builder, $where, 'pca.category', $filter->getCategories());
		
		return $where;
	}

	protected function getEntityType() {
		return Product::class;
	}
}
