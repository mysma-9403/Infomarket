<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Term;
use AppBundle\Entity\TermCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class TermCategoryAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 't.id AS termId';
		$fields[] = 't.name AS termName';
	
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->leftJoin(Term::class, 't', Join::WITH, 't.id = e.term');
		$builder->leftJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('t.name', 'ASC');
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return TermCategoryAssignment::class ;
	}
}
