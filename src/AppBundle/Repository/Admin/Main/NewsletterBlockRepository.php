<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Filter\Common\Main\NewsletterBlockFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class NewsletterBlockRepository extends SimpleRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->leftJoin(NewsletterPage::class, 'np', Join::WITH, 'np.id = e.newsletterPage');
		$builder->innerJoin(NewsletterBlockTemplate::class, 'nbt', Join::WITH, 
				'nbt.id = e.newsletterBlockTemplate');
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		$fields[] = 'np.id AS newsletterPageId';
		$fields[] = 'np.name AS newsletterPageName';
		$fields[] = 'nbt.id AS newsletterBlockTemplateId';
		$fields[] = 'nbt.name AS newsletterBlockTemplateName';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var NewsletterBlockFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addArrayWhere($builder, $where, 'e.newsletterPage', $filter->getNewsletterPages());
		$this->addArrayWhere($builder, $where, 'e.newsletterBlockTemplate', 
				$filter->getNewsletterBlockTemplates());
		
		return $where;
	}

	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		$fields[] = $item['subname'];
		
		return $fields;
	}

	protected function getEntityType() {
		return NewsletterBlock::class;
	}
}
