<?php

namespace AppBundle\Repository\Base;

use AppBundle\Filter\Base\Filter;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class BaseRepository extends EntityRepository
{
	public function findItem($id) {
		return $this->queryItem($id)->getSingleResult(AbstractQuery::HYDRATE_SCALAR);
	}
	
	protected function queryItem($id) {
		$builder = new QueryBuilder($this->getEntityManager());
			
		$this->buildItemSelect($builder);
		$builder->from($this->getEntityType(), "e");
		$this->buildItemJoins($builder);
		$builder->where($builder->expr()->eq('e.id', $id));
		$builder->setMaxResults(1);
	
		return $builder->getQuery();
	}
	
	private function buildItemSelect(QueryBuilder &$builder) {
		$select = implode(', ', $this->getItemSelectFields($builder));
		$builder->select($select);
	}
	
	protected function buildItemJoins(QueryBuilder &$builder) {
	}
	
	protected function getItemSelectFields(QueryBuilder &$builder) {
		return ['e.id'];
	}
	
	
	
	public function findItems(Filter $filter) {
		return $this->queryItems($filter)->getScalarResult();
	}
	
	/**
	 * 
	 * @param Filter $filter
	 * @return \Doctrine\ORM\Query
	 */
	public function queryItems(Filter $filter) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$this->buildSelect($builder, $filter);
		$this->buildFrom($builder, $filter);
		$this->buildJoins($builder, $filter);
		$this->buildWhere($builder, $filter);
		$this->buildOrderBy($builder, $filter);
		$this->buildLimit($builder, $filter);
		
		return $builder->getQuery();
	}
	
	
	
	private function buildSelect(QueryBuilder &$builder, Filter $filter) {
		$select = implode(', ', $this->getSelectFields($builder, $filter));
		$builder->select($select);
		$builder->distinct();
	}
	
	protected function buildFrom(QueryBuilder &$builder, Filter $filter) {
		$builder->from($this->getEntityType(), 'e');
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) { }
	
	private function buildWhere(QueryBuilder &$builder, Filter $filter) { 
		$where = $this->getWhere($builder, $filter);
		if($where && $where->count() > 0) $builder->where($where);
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) { }
	
	protected function buildLimit(QueryBuilder &$builder, Filter $filter) { }
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		return ['e.id'];
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) { 
		return $builder->expr()->andX(); 
	}
	
	
	
	public function findFilterItems() {
		$items = $this->queryFilterItems()->getScalarResult();
		return $this->getFilterItems($items);
	}
	
	protected function queryFilterItems() {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$this->buildFilterSelect($builder);
		$this->buildFilterFrom($builder);
		$this->buildFilterJoins($builder);
		$this->buildFilterWhere($builder);
		$this->buildFilterOrderBy($builder);
		$this->buildFilterLimit($builder);
	
		return $builder->getQuery();
	}
	
	
	
	private function buildFilterSelect(QueryBuilder &$builder) {
		$select = implode(', ', $this->getFilterSelectFields($builder));
		$builder->select($select);
	}
	
	protected function buildFilterFrom(QueryBuilder &$builder) {
		$builder->from($this->getEntityType(), 'e');
	}
	
	protected function buildFilterJoins(QueryBuilder &$builder) { }
	
	private function buildFilterWhere(QueryBuilder &$builder) {
		$where = $this->getFilterWhere($builder);
		if($where && $where->count() > 0) $builder->where($where);
	}
	
	protected function buildFilterOrderBy(QueryBuilder &$builder) {
		$builder->orderBy('e.name', 'ASC');
	}
	
	protected function buildFilterLimit(QueryBuilder &$builder) { }
	
	
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		return ['e.id', 'e.name'];
	}
	
	protected function getFilterWhere(QueryBuilder &$builder) {
		return $builder->expr()->andX();
	}
	
	
	
	protected function getFilterItems(array $items) {
		$listItems = array();
	
		foreach($items as $item) {
			$key = implode(' ', $this->getFilterItemKeyFields($item));
			$listItems[$key] = $item['id'];
		}
			
		return $listItems;
	}
	
	protected function getFilterItemKeyFields($item) {
		return [$item['id'], $item['name']];
	}
	
	
	
	
	
	protected function buildStringsExpression(QueryBuilder &$builder, $name, $string, $addDecorators = false) {
		$ors = explode(',', $string);
		
		$orExpr = $builder->expr()->orX();
		foreach($ors as $or) {
			$ands = explode('+', $or);
		
			$andExpr = $builder->expr()->andX();
			foreach ($ands as $and) {
				$andExpr->add($this->buildStringExpression($builder, $name, $and, $addDecorators));
			}
			
			$orExpr->add($andExpr);
		}
		
		return $orExpr;
	}
	
	protected function buildStringExpression(QueryBuilder &$builder, $name, $string, $addDecorators = false) {
		$not = false;
		
		$string = trim($string);
		
		if(substr($string, 0, 2) == '<>') {
			$string = str_replace('<>', '', $string);
			$not = true;
		}
	
		$string = str_replace('*', '%', $string);
		
		if($addDecorators) {
			if(substr($string, 0, 1) != '%') {
				$string = '%' . $string;
			}
			if(substr($string, strlen($string-1), 1) != '%') {
				$string = $string . '%';
			}
		}
		
		$string = $builder->expr()->literal($string);
		if($not) {
			return $builder->expr()->notLike($name, $string);
		} else {
			return $builder->expr()->like($name, $string);
		}
	}
    
	
	
	
    public function getIds($items) {
    	$result = array();
    	
    	foreach($items as $item) {
    		$result[] = $item['id'];
    	}
    	
    	return $result;
    }
    
    
    //TODO move to TreeRepository or Tree utils??
    protected function getRootItems(&$items) {
    	$rootItems = array();
    	
    	$size = count($items);
    	for($i = 0; $i < $size; $i++) {
    		$item = $items[$i];
    		
    		if($item['parent'] === null) {
    			$rootItems[] = $item;
    			array_splice($items, $i, 1);
    			$size--;
    			$i--;
    		}
    	}
    
    	return $rootItems;
    }
    
    protected function getRootItemsWithLimit(&$items, $limit) {
    	$rootItems = array();
    
    	$count = 0;
    	$size = count($items);
    	for($i = 0; $i < $size; $i++) {
    		$item = $items[$i];
    
    		if($item['parent'] === null) {
    			if($count < $limit) {
    				$rootItems[] = $item;
    				$count++;
    			}
    			
    			array_splice($items, $i, 1);
    			$size--;
    			$i--;
    		}
    	}
    
    	return $rootItems;
    }
    
    protected function assignChildren($rootItem, &$items, &$index) {
    	$children = array();
		
    	$size = count($items);
    	while($index < $size) {
    		$item = $items[$index];
    		
    		if($item['parent'] === $rootItem['id']) {
    			$children[] = $this->assignChildren($item, $items, ++$index);
    		} else {
    			break; //because of: ORDER BY treePath!
    		}
    	}
    
    	$rootItem['children'] = $children;
    
    	return $rootItem;
    }
    
    protected function assignChildrenWithLimit($rootItem, &$items, &$index, $limit) {
    	$children = array();
    
    	$count = 0;
    	$size = count($items);
    	while($index < $size) {
    		$item = $items[$index];
    
    		if($item['parent'] === $rootItem['id']) {
    			$index++;
    			if($count < $limit) {
    				$children[] = $this->assignChildrenWithLimit($item, $items, $index, $limit);
    				$count++;
    			}
    		} else {
    			break; //because of: ORDER BY treePath!
    		}
    	}
    
    	$rootItem['children'] = $children;
    
    	return $rootItem;
    }
    
    /**
     * Get entity type (e.g <strong>AppBundle:SimpleEntity</strong>)
     *
     * @return string
     */
	protected abstract function getEntityType();
}
