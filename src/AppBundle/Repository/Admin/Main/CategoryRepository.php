<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Category;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;
use AppBundle\Entity\BranchCategoryAssignment;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Filter\Admin\Main\CategoryFilter;

class CategoryRepository extends SimpleEntityRepository
{	
	protected function  buildJoins(QueryBuilder &$builder, Filter $filter) {
		/** @var CategoryFilter $filter */
		parent::buildJoins($builder, $filter);
	
		$builder->innerJoin(Category::class, 'p', Join::WITH, 'p.id = e.parent');
		
		if(count($filter->getBranches()) > 0) {
			$builder->leftJoin(BranchCategoryAssignment::class, 'bca', Join::WITH, 'e.id = bca.category');
		}
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		/** @var CategoryFilter $filter */
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.subname';
		$fields[] = 'e.featured';
		$fields[] = 'e.preleaf';
		
		$fields[] = 'p.id AS parentId';
		$fields[] = 'p.name AS parentName';
		$fields[] = 'p.subname AS parentSubname';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var CategoryFilter $filter */
		$where = parent::getWhere($builder, $filter);
	
		if(count($filter->getParents()) > 0) {
			$where->add($builder->expr()->in('e.parent', $filter->getParents()));
		}
	
		if(count($filter->getBranches()) > 0) {
			$where->add($builder->expr()->in('bca.branch', $filter->getBranches()));
		}
	
		if($filter->getFeatured() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.featured', $filter->getFeatured()));
		}
		
		if($filter->getPreleaf() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.preleaf', $filter->getPreleaf()));
		}
		
		if($filter->getSubname() && strlen($filter->getSubname()) > 0) {
			$where->add($this->buildStringsExpression($builder, 'e.subname', $filter->getSubname()));
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
		return Category::class;
	}
}
