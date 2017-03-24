<?php

namespace AppBundle\Repository\Admin\Base;

use AppBundle\Filter\Admin\Base\FeaturedEntityFilter;
use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;

abstract class FeaturedEntityRepository extends ImageEntityRepository
{	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.featured';
		
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var FeaturedEntityFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if($filter->getFeatured() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.featured', $filter->getFeatured()));
		}
		
		return $where;
	}
	
	public function setFeatured(array $items, $featured) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->update($this->getEntityType(), 'e');
		$builder->set('e.featured', $featured);
		$builder->where($builder->expr()->in('e.id', $items));
		
		$builder->getQuery()->execute();
	}
}
