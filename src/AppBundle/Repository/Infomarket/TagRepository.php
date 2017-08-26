<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class TagRepository extends BaseRepository {

	public function findItemsByArticles($articlesIds) {
		return $this->queryItemsByArticles($articlesIds)->getScalarResult();
	}

	protected function queryItemsByArticles($articlesIds) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select('e.id, e.name, IDENTITY(aba.article) AS article');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ArticleTagAssignment::class, 'aba', Join::WITH, 'e.id = aba.tag');
		
		$where = $expr->andX();
		$where->add($expr->in('aba.article', $articlesIds));
		$where->add($expr->eq('e.infomarket', 1));
		
		$builder->where($where);
		
		$builder->orderBy('e.name');
		
		return $builder->getQuery();
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	protected function getEntityType() {
		return Tag::class;
	}
}
