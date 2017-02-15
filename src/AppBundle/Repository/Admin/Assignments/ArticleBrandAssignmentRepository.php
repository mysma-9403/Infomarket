<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class ArticleBrandAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'a.id AS articleId';
		$fields[] = 'a.name AS articleName';
		$fields[] = 'a.subname AS articleSubname';
	
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->leftJoin(Article::class, 'a', Join::WITH, 'a.id = e.article');
		$builder->leftJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('a.name', 'ASC');
		$builder->addOrderBy('a.subname', 'ASC');
		$builder->addOrderBy('b.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ArticleBrandAssignment::class ;
	}
}
