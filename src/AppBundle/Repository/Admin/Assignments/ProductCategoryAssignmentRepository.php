<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\Segment;
use AppBundle\Entity\Brand;

class ProductCategoryAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'p.id AS productId';
		$fields[] = 'p.name AS productName';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		$fields[] = 's.id AS segmentId';
		$fields[] = 's.name AS segmentName';
	
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		
		$fields[] = 'e.featured';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->leftJoin(Product::class, 'p', Join::WITH, 'p.id = e.product');
		$builder->leftJoin(Brand::class, 'b', Join::WITH, 'b.id = p.brand');
		$builder->leftJoin(Segment::class, 's', Join::WITH, 's.id = e.segment');
		$builder->leftJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
		$builder->addOrderBy('s.name', 'ASC');
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('p.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ProductCategoryAssignment::class ;
	}
}
