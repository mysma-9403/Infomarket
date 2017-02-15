<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;
use AppBundle\Entity\NewsletterBlockTemplate;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\NewsletterPage;
use AppBundle\Filter\Admin\Main\NewsletterBlockFilter;

class NewsletterBlockRepository extends SimpleEntityRepository
{	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
	
		$builder->leftJoin(NewsletterPage::class, 'np', Join::WITH, 'np.id = e.newsletterPage');
		$builder->innerJoin(NewsletterBlockTemplate::class, 'nbt', Join::WITH, 'nbt.id = e.newsletterBlockTemplate');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'np.id AS newsletterPageId';
		$fields[] = 'np.name AS newsletterPageName';
		$fields[] = 'nbt.id AS newsletterBlockTemplateId';
		$fields[] = 'nbt.name AS newsletterBlockTemplateName';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var NewsletterBlockFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getNewsletterPages()) > 0) {
			$where->add($builder->expr()->in('e.newsletterPage', $filter->getNewsletterPages()));
		}
		
		if(count($filter->getNewsletterBlockTemplates()) > 0) {
			$where->add($builder->expr()->in('e.newsletterBlockTemplate', $filter->getNewsletterBlockTemplates()));
		}
	
		return $where;
	}
	
	
	
	
	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		parent::buildFilterOrderBy($builder);
		
		$builder->addOrderBy('e.subname', 'ASC');
	}
	
	
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.subname';
		
		return $fields;
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return NewsletterBlock::class;
	}
}
