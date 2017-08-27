<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Magazine;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;

class MagazineRepository extends BaseRepository {

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.name', 'ASC');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.image';
		$fields[] = 'e.date';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add($expr->eq('e.main', 0));
		
		$builder->where($where);
		
		return $where;
	}

	public function findItem($id) {
		return $this->queryItem($id)->getSingleResult(AbstractQuery::HYDRATE_SCALAR);
	}

	protected function queryItem($id) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.image, e.date");
		$builder->from($this->getEntityType(), "e");
		$builder->where($builder->expr()->eq('e.id', $id));
		$builder->setMaxResults(1);
		
		return $builder->getQuery();
	}

	public function findChildren($parentId) {
		return $this->queryChildren($parentId)->getScalarResult();
	}

	protected function queryChildren($parentId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.image, e.date");
		$builder->from($this->getEntityType(), "e");
		$builder->where($builder->expr()->eq('e.parent', $parentId));
		
		return $builder->getQuery();
	}

	public function findHomeItems() {
		return $this->queryHomeItems()->getScalarResult();
	}

	protected function queryHomeItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.image, e.date");
		$builder->from($this->getEntityType(), "e");
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infoprodukt', 1));
		$where->add($builder->expr()->eq('e.featured', 1));
		$where->add($builder->expr()->eq('e.main', 0));
		
		$builder->where($where);
		
		$builder->addOrderBy('e.orderNumber', 'ASC');
		$builder->addOrderBy('e.name', 'DESC');
		
		$builder->setMaxResults(6);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Magazine::class;
	}
}
