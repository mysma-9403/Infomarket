<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Entity\MagazineCategoryAssignment;
use AppBundle\Filter\Admin\Main\MagazineFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\ImageEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MagazineRepository extends ImageEntityRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		/** @var MagazineFilter $filter */
		
		if (count($filter->getBranches()) > 0) {
			$builder->leftJoin(MagazineBranchAssignment::class, 'mba', Join::WITH, 'e.id = mba.magazine');
		}
		
		if (count($filter->getCategories()) > 0) {
			$builder->leftJoin(MagazineCategoryAssignment::class, 'mca', Join::WITH, 'e.id = mca.magazine');
		}
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
		$fields[] = 'e.featured';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var MagazineFilter $filter */
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName());
		
		$this->addBooleanWhere($builder, $where, 'e.infomarket', $filter->getInfomarket());
		$this->addBooleanWhere($builder, $where, 'e.infoprodukt', $filter->getInfoprodukt());
		$this->addBooleanWhere($builder, $where, 'e.featured', $filter->getFeatured());
		
		$this->addArrayWhere($builder, $where, 'e.parent', $filter->getParents());
		$this->addArrayWhere($builder, $where, 'mba.branch', $filter->getBranches());
		$this->addArrayWhere($builder, $where, 'mca.category', $filter->getCategories());
		
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
		return Magazine::class;
	}
}
