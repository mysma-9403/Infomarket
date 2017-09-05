<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Main\ArticleCategory;
use AppBundle\Repository\Admin\Main\ArticleCategoryRepository as BaseRepository;
use Doctrine\ORM\QueryBuilder;

class ArticleCategoryRepository extends BaseRepository {

	protected function getFilterWhere(QueryBuilder &$builder) {
		$where = parent::getFilterWhere($builder);
		
		$expr = $builder->expr();
		$where->add($expr->eq('e.infoprodukt', 1));
		
		return $where;
	}

	public function findHomeItems() {
		return $this->queryHomeItems()->getScalarResult();
	}

	public function queryHomeItems() {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id, e.name, e.subname, e.image, e.vertical");
		$builder->from($this->getEntityType(), "e");
		
		$builder->where($builder->expr()->eq('e.infoprodukt', 1));
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return ArticleCategory::class;
	}
}
