<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Assignments\UserCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;

class CategoryRepository extends BaseRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
	}
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
	
		$fields[] = 'e.name';
		$fields[] = 'e.subname';
	
		return $fields;
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
	
		$expr = $builder->expr();
	
		$where->add($expr->eq('e.benchmark', 1));
		$where->add('e.parent IS NULL');
	
		$builder->where($where);
	
		return $where;
	}
	
	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
	
		$fields[] = $item['name'];
		$fields[] = $item['subname'];
		if (key_exists('parentName', $item) && $item['parentName']) {
			$fields[] = '(' . $item['parentName'];
			$fields[] = $item['parentSubname'] . ')';
		}
	
		return $fields;
	}
	
	public function findIdsByUser($userId) {
		$items = $this->queryIdsByUser($userId)->getScalarResult();
		return $this->getIds($items);
	}
	
	protected function queryIdsByUser($userId) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select("e.id");
		$builder->from($this->getEntityType(), "e");
	
		$builder->join(UserCategoryAssignment::class, 'uca', Join::WITH, 'e.id = uca.category');
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->eq('e.benchmark', 1));
		$where->add($expr->eq('uca.user', $userId));
	
		$builder->where($where);
	
		return $builder->getQuery();
	}
	
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
		$where->add($expr->eq('e.inProgress', 0));
		$where->add($expr->eq('uca.user', $userId));
		
		$builder->where($where);
		
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
		
		return $builder->getQuery();
	}

	public function findFilterItemsByUserAndCategory($userId, $categoryId, $includeInProgress = false) {
		$items = $this->queryFilterItemsByUserAndCategory($userId, $categoryId, $includeInProgress)->getScalarResult();
		return $this->getFilterItems($items);
	}

	protected function queryFilterItemsByUserAndCategory($userId, $categoryId, $includeInProgress = false) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname");
		$builder->from($this->getEntityType(), "e");
		
		$builder->join(UserCategoryAssignment::class, 'uca', Join::WITH, 'e.id = uca.category');
		
		$expr = $builder->expr();
		$where = $expr->andX();
		$where->add($expr->eq('e.preleaf', 0));
		$where->add($expr->eq('e.benchmark', 1));
		if(!$includeInProgress) $where->add($expr->eq('e.inProgress', 0));
		$where->add($expr->eq('e.parent', $categoryId));
		$where->add($expr->eq('uca.user', $userId));
		
		$builder->where($where);
		
		$builder->orderBy('e.inProgress', 'ASC');
		$builder->addOrderBy('e.treePath', 'ASC');
		
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
