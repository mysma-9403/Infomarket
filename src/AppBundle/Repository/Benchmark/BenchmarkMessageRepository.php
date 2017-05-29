<?php

namespace AppBundle\Repository\Benchmark;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\BenchmarkMessageFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Product;
use AppBundle\Entity\Brand;
use Doctrine\ORM\Query\Expr\Join;

class BenchmarkMessageRepository extends BaseRepository
{
	public function findUnreadItemsCount() {
		return $this->queryUnreadItemsCount()->getSingleScalarResult();
	}
	
	protected function queryUnreadItemsCount()
	{
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
	
	
	
	public function findItemsByAuthorAndProduct($authorId, $productId) {
		return $this->queryItemsByAuthorAndProduct($authorId, $productId)->getScalarResult();
	}
	
	protected function queryItemsByAuthorAndProduct($authorId, $productId)
	{
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
	
		$expr = $builder->expr();
	
		/** @var BenchmarkMessageFilter $filter */
		$where->add($expr->eq('e.createdBy', $filter->getContextUser()));
		
		if(count($filter->getProducts()) > 0) {
			$where->add($expr->in('e.product', $filter->getProducts()));
		}
		
		if(count($filter->getStates()) > 0) {
			$where->add($expr->in('e.state', $filter->getStates()));
		}
		
		if($filter->getName()) {
			$where->add($this->buildStringsExpression($builder, 'e.name', $filter->getName(), true));
		}
		
		if($filter->getReadByAuthor() != Filter::ALL_VALUES) {
			$where->add($expr->eq('e.readByAuthor', $filter->getReadByAuthor()));
		}
	
		return $where;
	}
	
	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}
	
	
	
	public function setRead(array $items, $read) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->update($this->getEntityType(), 'e');
		$builder->set('e.readByAuthor', $read);
		$builder->where($builder->expr()->in('e.id', $items));
	
		$builder->getQuery()->execute();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}
