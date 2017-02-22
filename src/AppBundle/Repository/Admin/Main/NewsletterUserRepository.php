<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Filter\Admin\Main\NewsletterUserFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\NewsletterUserNewsletterPageAssignment;
use Doctrine\ORM\Query\Expr\Join;

class NewsletterUserRepository extends SimpleEntityRepository
{
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
		
		$fields[] = 'e.subscribed';
		
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var NewsletterUserFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if($filter->getSubscribed() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.subscribed', $filter->getSubscribed()));
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
