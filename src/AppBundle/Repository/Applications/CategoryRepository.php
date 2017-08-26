<?php

namespace AppBundle\Repository\Applications;

use AppBundle\Entity\Category;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;

class CategoryRepository extends BaseRepository {

	public function findItemsByCategory($categoryId) {
		return $this->queryItemsByCategory($categoryId)->getScalarResult();
	}

	protected function queryItemsByCategory($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select("e.id as category, e.name, e.subname, e.image");
		$builder->from($this->getEntityType(), "e");
		
		$expr = $builder->expr();
		$where = $expr->andX();
		// $where->add($builder->expr()->eq('e.application', 1));
		$where->add($expr->like('e.treePath', $expr->literal('%-' . $categoryId . '#%')));
		$where->add($expr->neq('e.id', $categoryId));
		
		$builder->where($where);
		
		$builder->addOrderBy('e.name', 'ASC');
		$builder->addOrderBy('e.subname', 'ASC');
		
		return $builder->getQuery();
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	protected function getEntityType() {
		return Category::class;
	}
}
