<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Link;
use AppBundle\Filter\Common\Main\LinkFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;

class LinkRepository extends SimpleEntityRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		parent::buildOrderBy($builder, $filter);
		
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		
		$fields[] = 'e.url';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var LinkFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		
		$this->addStringWhere($builder, $where, 'e.url', $filter->getUrl());
		
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
		return Link::class;
	}
}
