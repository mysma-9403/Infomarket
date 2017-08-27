<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Filter\Admin\Main\NewsletterGroupFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterGroupRepository extends AuditRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterGroupFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		return $where;
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		
		return $fields;
	}

	public function findItemsByNewsletterUser($newsletterUserId) {
		return $this->queryItemsByNewsletterUser($newsletterUserId)->getScalarResult();
	}

	protected function queryItemsByNewsletterUser($newsletterUserId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name, nunga.id AS assignmentId');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(NewsletterUserNewsletterGroupAssignment::class, 'nunga', Join::WITH, 'e.id = nunga.newsletterGroup');
		
		$expr = $builder->expr();
		
		$builder->where($expr->eq('nunga.newsletterUser', $newsletterUserId));
		
		$builder->orderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	public function findItemsByIds($ids) {
		return $this->queryItemsByIds($ids)->getScalarResult();
	}

	protected function queryItemsByIds($ids) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name');
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$builder->where($expr->in('e.id', $ids));
		
		$builder->orderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}
