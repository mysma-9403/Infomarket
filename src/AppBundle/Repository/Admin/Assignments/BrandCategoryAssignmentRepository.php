<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Admin\Assignments\BrandCategoryAssignmentFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BrandCategoryAssignmentRepository extends AuditRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var BrandCategoryAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.brand', $filter->getBrands());
		$this->addArrayWhere($builder, $where, 'e.category', $filter->getCategories());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
	}

	protected function getEntityType() {
		return BrandCategoryAssignment::class;
	}
}
