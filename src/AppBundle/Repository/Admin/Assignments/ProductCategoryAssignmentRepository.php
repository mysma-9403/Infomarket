<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Main\Segment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Entity\Other\ProductScore;

class ProductCategoryAssignmentRepository extends SimpleRepository {

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
		
		$builder->innerJoin(Product::class, 'p', Join::WITH, 'p.id = e.product');
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = p.brand');
		$builder->innerJoin(Segment::class, 's', Join::WITH, 's.id = e.segment');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var ProductCategoryAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.product', $filter->getProducts());
		$this->addArrayWhere($builder, $where, 'p.brand', $filter->getBrands());
		$this->addArrayWhere($builder, $where, 'e.segment', $filter->getSegments());
		$this->addArrayWhere($builder, $where, 'e.category', $filter->getCategories());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
		$builder->addOrderBy('s.name', 'ASC');
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('p.name', 'ASC');
	}

	
	
	public function findItemsWithoutProductValue() {
		return $this->queryItemsWithoutProductValue()->getScalarResult();
	}
	
	protected function queryItemsWithoutProductValue() {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select("e.id");
		$builder->from($this->getEntityType(), "e");
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
		$builder->leftJoin(ProductValue::class, 'pv', Join::WITH, 'e.id = pv.productCategoryAssignment');
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('c.benchmark', 1));
		$where->add($expr->isNull('pv.id'));
	
		$builder->where($where);
	
		return $builder->getQuery();
	}
	
	public function findItemsWithoutProductScore() {
		return $this->queryItemsWithoutProductScore()->getScalarResult();
	}
	
	protected function queryItemsWithoutProductScore() {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select("e.id");
		$builder->from($this->getEntityType(), "e");
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
		$builder->leftJoin(ProductScore::class, 'ps', Join::WITH, 'e.id = ps.productCategoryAssignment');
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('c.benchmark', 1));
		$where->add($expr->isNull('ps.id'));
	
		$builder->where($where);
	
		return $builder->getQuery();
	}
	
	public function findItemsWithoutProductNote() {
		return $this->queryItemsWithoutProductNote()->getScalarResult();
	}
	
	protected function queryItemsWithoutProductNote() {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select("e.id");
		$builder->from($this->getEntityType(), "e");
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
		$builder->leftJoin(ProductNote::class, 'pn', Join::WITH, 'e.id = pn.productCategoryAssignment');
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('c.benchmark', 1));
		$where->add($expr->isNull('pn.id'));
	
		$builder->where($where);
	
		return $builder->getQuery();
	}
	
	protected function getEntityType() {
		return ProductCategoryAssignment::class;
	}
}
