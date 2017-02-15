<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Link;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Admin\Main\LinkFilter;

class LinkRepository extends SimpleEntityRepository
{	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.url';
		
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var LinkFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if($filter->getUrl() && strlen($filter->getUrl()) > 0) {
			$where->add($this->buildStringsExpression($builder, 'e.url', $filter->getUrl()));
		}
		
		return $where;
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Link::class;
	}
}
