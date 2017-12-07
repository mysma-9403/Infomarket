<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Assignments\UserCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Repository\Base\BaseRepository;
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

	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		$where->add($expr->eq('e.preleaf', 1));
		$where->add($expr->eq('e.benchmark', 1));
		
		return $where;
	}
	
	public function findHomeItems() {
		return $this->queryHomeItems()->getScalarResult();
	}
	
	protected function queryHomeItems() {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select("e.id, e.name, e.subname, e.image, e.vertical, e.featuredImage");
		$builder->from($this->getEntityType(), "e");
	
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.benchmark', 1));
		$where->add($builder->expr()->eq('e.featured', 1));
		$where->add($builder->expr()->eq('e.preleaf', 1));
	
		$builder->where($where);
	
		$builder->addOrderBy('e.orderNumber', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	
		$builder->setMaxResults(4);
	
		return $builder->getQuery();
	}
	
	protected function getEntityType() {
		return Category::class;
	}
}
