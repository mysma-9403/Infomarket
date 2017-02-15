<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Filter\Admin\Main\NewsletterUserFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;

class NewsletterUserRepository extends SimpleEntityRepository
{
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
