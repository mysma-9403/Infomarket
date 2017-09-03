<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\ImageRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ProductRepository extends ImageRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		/** @var ProductFilter $filter */
		
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		
		if (count($filter->getCategories()) > 0) {
			$builder->leftJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		}
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var ProductFilter $filter */
		
		$expr = $builder->expr();
		
		$where->add($expr->isNull('e.benchmarkQuery'));
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		
		$this->addArrayWhere($builder, $where, 'e.brand', $filter->getBrands());
		$this->addArrayWhere($builder, $where, 'pca.category', $filter->getCategories());
		
		return $where;
	}

	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function buildFilterJoins(QueryBuilder &$builder) {
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		$fields[] = 'b.name AS brandName';
		
		return $fields;
	}

	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		
		$where->add($expr->isNull('e.benchmarkQuery'));
		
		return $where;
	}

	protected function getFilterItemKeyFields($item) {
		return [ $item['id'],$item['brandName'],$item['name'] 
		];
	}

	protected function getEntityType() {
		return Product::class;
	}
}
