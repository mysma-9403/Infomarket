<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\Segment;
use AppBundle\Repository\Admin\Base\ImageRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;

class SegmentRepository extends ImageRepository {

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
		/** @var SegmentFilter $filter */
		
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

	public function findTopItems() {
		return $this->queryTopItems()->getScalarResult();
	}

	protected function queryTopItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->orderBy('e.orderNumber', 'ASC');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Segment::class;
	}
}
