<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Menu;
use AppBundle\Filter\Admin\Main\MenuFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;

class MenuRepository extends SimpleEntityRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var MenuFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		
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
		return Menu::class;
	}
}
