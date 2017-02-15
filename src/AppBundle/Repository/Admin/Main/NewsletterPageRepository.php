<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Filter\Admin\Main\NewsletterPageFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\NewsletterPageTemplate;
use Doctrine\ORM\Query\Expr\Join;

class NewsletterPageRepository extends SimpleEntityRepository
{
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(NewsletterPageTemplate::class, 'npt', Join::WITH, 'npt.id = e.newsletterPageTemplate');
	}
	
	
		
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'npt.id AS newsletterPageTemplateId';
		$fields[] = 'npt.name AS newsletterPageTemplateName';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var NewsletterPageFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if(count($filter->getNewsletterPageTemplates()) > 0) {
			$where->add($builder->expr()->in('e.newsletterPageTemplate', $filter->getNewsletterPageTemplates()));
		}
	
		return $where;
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterPage::class;
	}
}
