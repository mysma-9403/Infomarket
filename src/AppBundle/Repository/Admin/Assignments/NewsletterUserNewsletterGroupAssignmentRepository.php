<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\NewsletterGroup;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;

class NewsletterUserNewsletterGroupAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'nu.id AS newsletterUserId';
		$fields[] = 'nu.name AS newsletterUserName';
	
		$fields[] = 'ng.id AS newsletterGroupId';
		$fields[] = 'ng.name AS newsletterGroupName';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(NewsletterUser::class, 'nu', Join::WITH, 'nu.id = e.newsletterUser');
		$builder->innerJoin(NewsletterGroup::class, 'ng', Join::WITH, 'ng.id = e.newsletterGroup');
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var NewsletterUserNewsletterGroupAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getNewsletterUsers()) > 0) {
			$where->add($builder->expr()->in('e.newsletterUser', $filter->getNewsletterUsers()));
		}
	
		if(count($filter->getNewsletterGroups()) > 0) {
			$where->add($builder->expr()->in('e.newsletterGroup', $filter->getNewsletterGroups()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('ng.name', 'ASC');
		$builder->addOrderBy('nu.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignment::class ;
	}
}
