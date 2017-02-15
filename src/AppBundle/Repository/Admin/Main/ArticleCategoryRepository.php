<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Admin\Main\ArticleCategoryFilter;

class ArticleCategoryRepository extends SimpleEntityRepository
{
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.subname', 'ASC');
	}
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.subname';
		$fields[] = 'e.featured';
		
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var ArticleCategoryFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if($filter->getSubname() && strlen($filter->getSubname()) > 0) {
			$where->add($this->buildStringsExpression($builder, 'e.subname', $filter->getSubname()));
		}
		
		if($filter->getFeatured() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.featured', $filter->getFeatured()));
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
		return ArticleCategory::class;
	}
}
