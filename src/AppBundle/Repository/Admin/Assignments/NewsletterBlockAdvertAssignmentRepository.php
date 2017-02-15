<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockAdvertAssignment;
use AppBundle\Entity\Advert;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class NewsletterBlockAdvertAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'nb.id AS newsletterBlockId';
		$fields[] = 'nb.name AS newsletterBlockName';
		$fields[] = 'nb.subname AS newsletterBlockSubname';
	
		$fields[] = 'a.id AS advertId';
		$fields[] = 'a.name AS advertName';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->leftJoin(NewsletterBlock::class, 'nb', Join::WITH, 'nb.id = e.newsletterBlock');
		$builder->leftJoin(Advert::class, 'a', Join::WITH, 'a.id = e.advert');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('nb.name', 'ASC');
		$builder->addOrderBy('nb.subname', 'ASC');
		$builder->addOrderBy('a.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterBlockAdvertAssignment::class ;
	}
}
