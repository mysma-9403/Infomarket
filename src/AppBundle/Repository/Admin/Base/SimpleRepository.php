<?php

namespace AppBundle\Repository\Admin\Base;

use AppBundle\Filter\Admin\Base\SimpleFilter;
use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\QueryBuilder;

abstract class SimpleRepository extends AuditRepository
{
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.infomarket';
		$fields[] = 'e.infoprodukt';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		/** @var SimpleFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		if($filter->getInfomarket() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.infomarket', $filter->getInfomarket()));
		}
		
		if($filter->getInfoprodukt() != Filter::ALL_VALUES) {
			$where->add($builder->expr()->eq('e.infoprodukt', $filter->getInfoprodukt()));
		}
		
		return $where;
	}
	
	public function setIMPublished(array $items, $published) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->update($this->getEntityType(), 'e');
		$builder->set('e.infomarket', $published);
		$builder->where($builder->expr()->in('e.id', $items));
		
		$builder->getQuery()->execute();
	}
	
	public function setIPPublished(array $items, $published) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->update($this->getEntityType(), 'e');
		$builder->set('e.infoprodukt', $published);
		$builder->where($builder->expr()->in('e.id', $items));
	
		$builder->getQuery()->execute();
	}
}
