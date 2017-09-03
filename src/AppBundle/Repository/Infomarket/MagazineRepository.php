<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Assignments\MagazineBranchAssignment;
use AppBundle\Entity\Main\Magazine;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Infomarket\Base\BranchDependentFilter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class MagazineRepository extends BaseRepository {

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		$builder->innerJoin(MagazineBranchAssignment::class, 'mba', Join::WITH, 'e.id = mba.magazine');
	}

	protected function buildOrderBy(QueryBuilder &$builder, Filter $filter) {
		$builder->addOrderBy('e.orderNumber', 'ASC');
		$builder->addOrderBy('e.date', 'DESC');
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
		/** @var BranchDependentFilter $filter */
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.infomarket', 1));
		$where->add($expr->eq('e.main', 1));
		$where->add($expr->eq('mba.branch', $filter->getContextBranch()));
		
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
		
		$builder->select("e.id, e.name, e.image");
		$builder->from($this->getEntityType(), "e");
		$builder->where($builder->expr()->eq('e.parent', $parentId));
		
		return $builder->getQuery();
	}

	public function findHomeItems($branchId) {
		return $this->queryHomeItems($branchId)->getScalarResult();
	}

	protected function queryHomeItems($branchId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.image, e.date");
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(MagazineBranchAssignment::class, 'mba', Join::WITH, 'e.id = mba.magazine');
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infomarket', 1));
		$where->add($builder->expr()->eq('e.featured', 1));
		$where->add($builder->expr()->eq('e.main', 1));
		
		$where->add($builder->expr()->eq('mba.branch', $branchId));
		
		$builder->where($where);
		
		$builder->addOrderBy('e.orderNumber', 'ASC');
		$builder->addOrderBy('e.name', 'DESC');
		
		$builder->setMaxResults(4);
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Magazine::class;
	}
}
