<?php

namespace AppBundle\Repository\Admin\Other;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use Doctrine\ORM\Query\Expr\Join;

class SendNewsletterRepository extends BaseRepository
{
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		if(count($filter->getGroups()) > 0) {
			$builder->join(NewsletterUserNewsletterGroupAssignment::class, 'nunga', Join::WITH, 'e.id = nunga.newsletterUser');
		}
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		return ['e.id', 'e.name'];
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var SendNewsletterFilter $filter */
		$expr = $builder->expr();
		
		$where = $expr->andX();
		
		$where->add($expr->eq('e.subscribed', 1));
		
		if(count($filter->getGroups()) > 0) {
			$where->add($expr->in('nunga.newsletterGroup', $filter->getGroups()));
		}
		
		return $where;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterUser::class;
	}
}
