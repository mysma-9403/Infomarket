<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\QueryBuilder;

class NewsletterPageTemplateRepository extends AuditRepository
{	
    protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.name';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var SimpleEntityFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
	
		if($filter->getName() && strlen($filter->getName()) > 0) {
			$where->add($this->buildStringsExpression($builder, 'e.name', $filter->getName()));
		}
	
		return $where;
	}
	
	protected function getEntityType() {
		return NewsletterPageTemplate::class;
	}
}
