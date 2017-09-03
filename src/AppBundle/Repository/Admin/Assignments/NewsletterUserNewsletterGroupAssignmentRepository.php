<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Entity\Main\NewsletterGroup;
use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterUserNewsletterGroupAssignmentRepository extends SimpleRepository {

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
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterUserNewsletterGroupAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.newsletterUser', $filter->getNewsletterUsers());
		$this->addArrayWhere($builder, $where, 'e.newsletterGroup', $filter->getNewsletterGroups());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('ng.name', 'ASC');
		$builder->addOrderBy('nu.name', 'ASC');
	}

	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignment::class;
	}
}
