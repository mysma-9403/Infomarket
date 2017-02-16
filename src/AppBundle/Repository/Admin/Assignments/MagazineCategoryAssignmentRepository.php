<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class MagazineCategoryAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'm.id AS magazineId';
		$fields[] = 'm.name AS magazineName';
	
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Magazine::class, 'm', Join::WITH, 'm.id = e.magazine');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var MagazineCategoryAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getMagazines()) > 0) {
			$where->add($builder->expr()->in('e.magazine', $filter->getMagazines()));
		}
	
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('e.category', $filter->getCategories()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('m.name', 'ASC');
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return MagazineCategoryAssignment::class ;
	}
}
