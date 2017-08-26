<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use AppBundle\Filter\Admin\Main\NewsletterUserFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterUserRepository extends SimpleEntityRepository {

	public function findItemsIdsByNewsletterPage($newsletterUsersIds, $newsletterPageId) {
		$items = $this->queryItemsByNewsletterPage($newsletterUsersIds, $newsletterPageId)->getScalarResult();
		return $this->getIds($items);
	}

	protected function queryItemsByNewsletterPage($newsletterUsersIds, $newsletterPageId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(NewsletterUserNewsletterPageAssignment::class, 'nunpa', Join::WITH, 'e.id = nunpa.newsletterUser');
		
		$expr = $builder->expr();
		
		$builder->where($expr->eq('nunpa.newsletterPage', $newsletterPageId));
		$builder->where($expr->in('e.id', $newsletterUsersIds));
		
		return $builder->getQuery();
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		$fields[] = 'e.subscribed';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterUserFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.subscribed', $filter->getSubscribed());
		
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

	protected function getEntityType() {
		return NewsletterUser::class;
	}
}
