<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Filter\Common\Assignments\NewsletterUserNewsletterPageAssignmentFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterUserNewsletterPageAssignmentRepository extends AuditRepository {

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
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterUserNewsletterPageAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.newsletterUser', $filter->getNewsletterUsers());
		$this->addArrayWhere($builder, $where, 'e.newsletterPage', $filter->getNewsletterPages());
		$this->addArrayWhere($builder, $where, 'e.state', $filter->getStates());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('np.name', 'ASC');
		$builder->addOrderBy('nu.name', 'ASC');
	}

	protected function getEntityType() {
		return NewsletterUserNewsletterPageAssignment::class;
	}
}
