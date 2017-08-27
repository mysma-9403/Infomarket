<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Repository\Admin\Main\ArticleCategoryRepository as BaseRepository;
use Doctrine\ORM\QueryBuilder;

class ArticleCategoryRepository extends BaseRepository {
	
	// TODO the same as in admin -> make common + env agnostic:
	// $where->add($expr->eq('e.infomarket', 1)); can be set in IM filter
	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		$where->add($expr->eq('e.infomarket', 1));
		
		return $where;
	}

	public function findMenuItems() {
		return $this->queryMenuItems()->getScalarResult();
	}

	public function queryMenuItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname");
		$builder->from($this->getEntityType(), "e");
		
		$where = $builder->expr()->andX();
		$where->add($builder->expr()->eq('e.infomarket', 1));
		$where->add($builder->expr()->eq('e.featured', 1));
		$builder->where($where);
		
		$builder->addOrderBy('e.orderNumber', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	public function findHomeItems() {
		return $this->queryHomeItems()->getScalarResult();
	}

	public function queryHomeItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname, e.image, e.vertical");
		$builder->from($this->getEntityType(), "e");
		
		$builder->where($builder->expr()->eq('e.infomarket', 1));
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return ArticleCategory::class;
	}
}
