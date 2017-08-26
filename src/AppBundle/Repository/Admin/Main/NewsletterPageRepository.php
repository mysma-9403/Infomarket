<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Filter\Admin\Main\NewsletterPageFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterPageRepository extends AuditRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(NewsletterPageTemplate::class, 'npt', Join::WITH, 'npt.id = e.newsletterPageTemplate');
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'npt.id AS newsletterPageTemplateId';
		$fields[] = 'npt.name AS newsletterPageTemplateName';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterPageFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addArrayWhere($builder, $where, 'e.newsletterPageTemplate', $filter->getNewsletterPageTemplates());
		
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
		return NewsletterPage::class;
	}
}
