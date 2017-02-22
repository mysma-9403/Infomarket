<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use Doctrine\ORM\Query\Expr\Join;

class NewsletterGroupRepository extends SimpleEntityRepository
{
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
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterGroup::class;
	}
}
