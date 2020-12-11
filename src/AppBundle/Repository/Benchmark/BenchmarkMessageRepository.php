<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\BenchmarkMessageFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BenchmarkMessageRepository extends BaseRepository {

	public function findUnreadItemsCount() {
		return $this->queryUnreadItemsCount()->getSingleScalarResult();
	}

	protected function queryUnreadItemsCount() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select($expr->count('e.id') . ' AS vcount');
		$builder->from($this->getEntityType(), "e");
		
		$where = $expr->andX();
		$where->add($expr->isNull('e.parent'));
		$where->add($expr->eq('e.readByAuthor', 0));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}
	
	public function findUnreadItemsCountByAuthor($userId) {
		return $this->queryUnreadItemsCountByAuthor($userId)->getSingleScalarResult();
	}
	
	protected function queryUnreadItemsCountByAuthor($userId) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select($expr->count('e.id') . ' AS vcount');
		$builder->from($this->getEntityType(), "e");
	
		$where = $expr->andX();
		$where->add($expr->isNull('e.parent'));
		$where->add($expr->eq('e.readByAuthor', 0));
		$where->add($expr->eq('e.author', $userId));
	
		$builder->where($where);
	
		return $builder->getQuery();
	}

	public function findItemsByAuthorAndProduct($authorId, $productId) {
		return $this->queryItemsByAuthorAndProduct($authorId, $productId)->getScalarResult();
	}

	protected function queryItemsByAuthorAndProduct($authorId, $productId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.content, e.state, IDENTITY(e.author), e.readByAuthor");
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		$where->add($expr->eq('e.author', $authorId));
		$where->add($expr->eq('e.product', $productId));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.state';
		$fields[] = 'e.readByAuthor';
		
		$fields[] = 'p.id AS productId';
		$fields[] = 'p.name AS productName';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		return $fields;
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(Product::class, 'p', Join::WITH, 'p.id = e.product');
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = p.brand');
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		/** @var BenchmarkMessageFilter $filter */
		
		$expr = $builder->expr();
		
		$where->add($expr->isNull('e.parent'));
		$where->add($expr->eq('e.createdBy', $filter->getContextUser()));
		
		$this->addArrayWhere($builder, $where, 'e.product', $filter->getProducts());
		$this->addArrayWhere($builder, $where, 'e.state', $filter->getStates());
		
		$this->addStringWhere($builder, $where, 'e.name', $filter->getName(), true);
		
		$this->addBooleanWhere($builder, $where, 'e.readByAuthor', $filter->getReadByAuthor());
		
		return $where;
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}
