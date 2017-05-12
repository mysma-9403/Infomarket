<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;
use AppBundle\Entity\User;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Filter\Admin\Main\BenchmarkMessageFilter;
use AppBundle\Entity\Product;
use AppBundle\Entity\Brand;

class BenchmarkMessageRepository extends SimpleEntityRepository
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
		$where->add($expr->eq('e.readByAdmin', 0));
	
		$builder->where($where);
			
		return $builder->getQuery();
	}
	
	
	
	
	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.state';
		$fields[] = 'e.readByAdmin';
		
		$fields[] = 'a.id AS authorId';
		$fields[] = 'a.username AS authorName';
		
		$fields[] = 'p.id AS productId';
		$fields[] = 'p.name AS productName';
		
		$fields[] = 'b.id AS brandId';
		$fields[] = 'b.name AS brandName';
		
		return $fields;
	}
	
	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		parent::buildJoins($builder, $filter);
		
		$builder->innerJoin(User::class, 'a', Join::WITH, 'a.id = e.author');
		$builder->innerJoin(Product::class, 'p', Join::WITH, 'p.id = e.product');
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = p.brand');
	}
	
	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		
		$expr = $builder->expr();
		
		$where->add($expr->isNull('e.parent'));
		
		/** @var BenchmarkMessageFilter $filter */
		if(count($filter->getProducts()) > 0) {
			$where->add($expr->in('e.product', $filter->getProducts()));
		}
		
		if(count($filter->getAuthors()) > 0) {
			$where->add($expr->in('e.author', $filter->getAuthors()));
		}
		
		if(count($filter->getStates()) > 0) {
			$where->add($expr->in('e.state', $filter->getStates()));
		}
		
		if($filter->getReadByAdmin() != Filter::ALL_VALUES) {
			$where->add($expr->eq('e.readByAdmin', $filter->getReadByAdmin()));
		}
		
		return $where;
	}
	
	
	
	
	public function setRead(array $items, $read) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->update($this->getEntityType(), 'e');
		$builder->set('e.readByAdmin', $read);
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
