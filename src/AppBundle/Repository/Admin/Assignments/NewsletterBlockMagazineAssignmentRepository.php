<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterBlockMagazineAssignmentRepository extends AuditRepository {

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
		
		$builder->innerJoin(NewsletterBlock::class, 'nb', Join::WITH, 'nb.id = e.newsletterBlock');
		$builder->innerJoin(Magazine::class, 'm', Join::WITH, 'm.id = e.magazine');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterBlockMagazineAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.newsletterBlock', $filter->getNewsletterBlocks());
		$this->addArrayWhere($builder, $where, 'e.magazine', $filter->getMagazines());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('nb.name', 'ASC');
		$builder->addOrderBy('nb.subname', 'ASC');
		$builder->addOrderBy('m.name', 'ASC');
	}

	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class;
	}
}
