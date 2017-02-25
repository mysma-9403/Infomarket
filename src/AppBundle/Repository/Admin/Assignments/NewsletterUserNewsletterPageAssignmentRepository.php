<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Filter\Admin\Assignments\NewsletterUserNewsletterPageAssignmentFilter;

class NewsletterUserNewsletterPageAssignmentRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'nu.id AS newsletterUserId';
		$fields[] = 'nu.name AS newsletterUserName';
	
		$fields[] = 'np.id AS newsletterPageId';
		$fields[] = 'np.name AS newsletterPageName';
		
		$fields[] = 'e.state';
		$fields[] = 'e.processingTime';
	
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(NewsletterUser::class, 'nu', Join::WITH, 'nu.id = e.newsletterUser');
		$builder->innerJoin(NewsletterPage::class, 'np', Join::WITH, 'np.id = e.newsletterPage');
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var NewsletterUserNewsletterPageAssignmentFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getNewsletterUsers()) > 0) {
			$where->add($builder->expr()->in('e.newsletterUser', $filter->getNewsletterUsers()));
		}
	
		if(count($filter->getNewsletterPages()) > 0) {
			$where->add($builder->expr()->in('e.newsletterPage', $filter->getNewsletterPages()));
		}
		
		if(count($filter->getStates()) > 0) {
			$where->add($builder->expr()->in('e.state', $filter->getStates()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('np.name', 'ASC');
		$builder->addOrderBy('nu.name', 'ASC');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterUserNewsletterPageAssignment::class ;
	}
}
