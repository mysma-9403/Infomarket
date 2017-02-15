<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Magazine;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\MagazineCategoryAssignment;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Filter\Admin\Main\MagazineFilter;

class MagazineRepository extends SimpleEntityRepository
{
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var MagazineFilter $filter */
		parent::buildJoins($builder, $filter);
		
		if(count($filter->getBranches()) > 0) {
			$builder->leftJoin(MagazineBranchAssignment::class, 'mba', Join::WITH, 'e.id = mba.magazine');
		}
		
		if(count($filter->getCategories()) > 0) {
			$builder->leftJoin(MagazineCategoryAssignment::class, 'mca', Join::WITH, 'e.id = mca.magazine');
		}
	}
	
	

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var MagazineFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.featured';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var MagazineFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if(count($filter->getParents()) > 0) {
			$where->add($builder->expr()->in('e.parent', $filter->getParents()));
		}
		
		if(count($filter->getBranches()) > 0) {
			$where->add($builder->expr()->in('mba.branch', $filter->getBranches()));
		}
		
		if(count($filter->getCategories()) > 0) {
			$where->add($builder->expr()->in('mca.category', $filter->getCategories()));
		}
		
		if($filter->getFeatured() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.featured', $filter->getFeatured()));
		}
	
		return $where;
	}
	
	
	
	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
	
		$where->add('e.parent IS NULL');
	
		return $where;
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Magazine::class;
	}
}
