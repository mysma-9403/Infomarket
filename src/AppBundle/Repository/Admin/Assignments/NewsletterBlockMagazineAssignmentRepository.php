<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Entity\Magazine;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class NewsletterBlockMagazineAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'nb.id AS newsletterBlockId';
		$fields[] = 'nb.name AS newsletterBlockName';
		$fields[] = 'nb.subname AS newsletterBlockSubname';
	
		$fields[] = 'm.id AS magazineId';
		$fields[] = 'm.name AS magazineName';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->leftJoin(NewsletterBlock::class, 'nb', Join::WITH, 'nb.id = e.newsletterBlock');
		$builder->leftJoin(Magazine::class, 'm', Join::WITH, 'm.id = e.magazine');
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('nb.name', 'ASC');
		$builder->addOrderBy('nb.subname', 'ASC');
		$builder->addOrderBy('m.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class ;
	}
}
