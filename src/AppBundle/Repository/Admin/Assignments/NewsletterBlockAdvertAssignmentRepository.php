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
		
		$builder->innerJoin(NewsletterBlock::class, 'nb', Join::WITH, 'nb.id = e.newsletterBlock');
		$builder->innerJoin(Advert::class, 'a', Join::WITH, 'a.id = e.advert');
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var NewsletterBlockAdvertAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getNewsletterBlocks()) > 0) {
			$where->add($builder->expr()->in('e.newsletterBlock', $filter->getNewsletterBlocks()));
		}
	
		if(count($filter->getAdverts()) > 0) {
			$where->add($builder->expr()->in('e.advert', $filter->getAdverts()));
		}
	
		return $where;
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
