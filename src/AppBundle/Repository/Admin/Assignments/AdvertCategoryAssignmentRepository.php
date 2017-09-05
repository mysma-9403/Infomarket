<?php

namespace AppBundle\Repository\Admin\Assignments;

use AppBundle\Entity\Assignments\AdvertCategoryAssignment;
use AppBundle\Entity\Main\Advert;
use AppBundle\Entity\Main\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Assignments\AdvertCategoryAssignmentFilter;
use AppBundle\Repository\Admin\Base\SimpleRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class AdvertCategoryAssignmentRepository extends SimpleRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'a.id AS advertId';
		$fields[] = 'a.name AS advertName';
		
		$fields[] = 'c.id AS categoryId';
		$fields[] = 'c.name AS categoryName';
		$fields[] = 'c.subname AS categorySubname';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Advert::class, 'a', Join::WITH, 'a.id = e.advert');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = e.category');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var AdvertCategoryAssignmentFilter $filter */
		
		$this->addArrayWhere($builder, $where, 'e.advert', $filter->getAdverts());
		$this->addArrayWhere($builder, $where, 'e.category', $filter->getCategories());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('a.name', 'ASC');
		$builder->addOrderBy('c.name', 'ASC');
		$builder->addOrderBy('c.subname', 'ASC');
	}

	protected function getEntityType() {
		return AdvertCategoryAssignment::class;
	}
}
