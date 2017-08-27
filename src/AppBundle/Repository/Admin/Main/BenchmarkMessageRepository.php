<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use AppBundle\Filter\Admin\Main\BenchmarkMessageFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Base\AuditRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BenchmarkMessageRepository extends AuditRepository {

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
		$where->add($expr->eq('e.readByAdmin', 0));
		
		$builder->where($where);
		
		return $builder->getQuery();
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
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
		/** @var BenchmarkMessageFilter $filter */
		$where = parent::getWhere($builder, $filter);
		
		$where->add($builder->expr()->isNull('e.parent'));
		
		$this->addBooleanWhere($builder, $where, 'e.readByAdmin', $filter->getReadByAdmin());
		
		$this->addArrayWhere($builder, $where, 'e.product', $filter->getProducts());
		$this->addArrayWhere($builder, $where, 'e.author', $filter->getAuthors());
		$this->addArrayWhere($builder, $where, 'e.state', $filter->getStates());
		
		return $where;
	}

	protected function getFilterSelectFields(QueryBuilder &$builder) {
		$fields = parent::getFilterSelectFields($builder);
		
		$fields[] = 'e.name';
		
		return $fields;
	}

	protected function getFilterItemKeyFields($item) {
		$fields = parent::getFilterItemKeyFields($item);
		
		$fields[] = $item['name'];
		
		return $fields;
	}

	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}
