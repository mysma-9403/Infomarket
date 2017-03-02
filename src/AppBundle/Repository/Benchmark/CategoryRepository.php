<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class CategoryRepository extends BaseRepository
{	
	public function findFilterItemsByCategory($categoryId) {
		$items = $this->queryFilterItemsByCategory($categoryId)->getScalarResult();
		return $this->getFilterItems($items);
	}
	
	protected function queryFilterItemsByCategory($categoryId)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.subname");
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		$where = $expr->andX();
		$where->add($builder->expr()->eq('e.benchmark', 1));
		$where->add($expr->eq('e.parent', $categoryId));
	
		$builder->where($where);
	
		$builder->orderBy('e.treePath', 'ASC');
			
		return $builder->getQuery();
	}
	
	protected function getItemSelectFields(QueryBuilder &$builder) {
		$fields = parent::getItemSelectFields($builder);
		
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
		
		return $fields;
	}
	
	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		$where->add($expr->eq('e.preleaf', 1));
		$where->add($expr->eq('e.benchmark', 1));
		
		return $where;
	}
	
	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.subname';
		
		return $fields;
	}
	
	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
	
		$fields[] = $item['subname'];
	
		return $fields;
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Category::class ;
	}
}
