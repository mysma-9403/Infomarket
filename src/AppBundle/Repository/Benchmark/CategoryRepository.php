<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Entity\UserCategoryAssignment;
use AppBundle\Repository\Admin\Main\CategoryRepository as BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class CategoryRepository extends BaseRepository {

	public function findFilterItemsByUser($userId) {
		$items = $this->queryFilterItemsByUser($userId)->getScalarResult();
		return $this->getFilterItems($items);
	}

	protected function queryFilterItemsByUser($userId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname");
		$builder->from($this->getEntityType(), "e");
		
		$builder->join(UserCategoryAssignment::class, 'uca', Join::WITH, 'e.id = uca.category');
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.preleaf', 1));
		$where->add($expr->eq('e.benchmark', 1));
		$where->add($expr->eq('uca.user', $userId));
		
		$builder->where($where);
		
		$builder->orderBy('e.treePath', 'ASC');
		
		return $builder->getQuery();
	}

	public function findFilterItemsByUserAndCategory($userId, $categoryId) {
		$items = $this->queryFilterItemsByUserAndCategory($userId, $categoryId)->getScalarResult();
		return $this->getFilterItems($items);
	}

	protected function queryFilterItemsByUserAndCategory($userId, $categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname");
		$builder->from($this->getEntityType(), "e");
		
		$builder->join(UserCategoryAssignment::class, 'uca', Join::WITH, 'e.id = uca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
		$where->add($expr->eq('e.preleaf', 0));
		$where->add($expr->eq('e.benchmark', 1));
		$where->add($expr->eq('e.parent', $categoryId));
		$where->add($expr->eq('uca.user', $userId));
		
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
}
