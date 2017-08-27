<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Advert;
use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Filter\Admin\Main\AdvertFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class AdvertRepository extends ImageEntityRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var AdvertFilter $filter */
		parent::buildJoins($builder, $filter);
		
		if (count($filter->getCategories()) > 0) {
			$builder->leftJoin(AdvertCategoryAssignment::class, 'aca', Join::WITH, 'e.id = aca.advert');
		}
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->orderBy('e.createdAt', 'DESC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		
		$fields[] = 'e.link';
		$fields[] = 'e.showCount';
		$fields[] = 'e.showLimit';
		$fields[] = 'e.clickCount';
		$fields[] = 'e.clickLimit';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var AdvertFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfomarket());
		
		$this->addArrayWhere($builder, $where, 'e.location', $filter->getLocations());
		$this->addArrayWhere($builder, $where, 'aca.category', $filter->getCategories());
		
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
		return Advert::class;
	}
}
