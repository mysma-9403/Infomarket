<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Advert;
use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockAdvertAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterBlockAdvertAssignmentRepository extends AuditRepository {

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
		
		$builder->innerJoin(NewsletterBlock::class, 'nb', Join::WITH, 'nb.id = e.newsletterBlock');
		$builder->innerJoin(Advert::class, 'a', Join::WITH, 'a.id = e.advert');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterBlockAdvertAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.newsletterBlock', $filter->getNewsletterBlocks());
		$this->addArrayWhere($builder, $where, 'e.advert', $filter->getAdverts());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('nb.name', 'ASC');
		$builder->addOrderBy('nb.subname', 'ASC');
		$builder->addOrderBy('a.name', 'ASC');
	}

	protected function getEntityType() {
		return NewsletterBlockAdvertAssignment::class;
	}
}
