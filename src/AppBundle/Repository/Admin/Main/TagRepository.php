<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Repository\Admin\Base\SimpleEntityRepository;
use Doctrine\ORM\QueryBuilder;

class TagRepository extends SimpleEntityRepository
{
	public function findItemsByNames($names) {
		return $this->queryItemsByNames($names)->getScalarResult();
	}
	
	protected function queryItemsByNames($names) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select('e.id, e.name');
		$builder->from($this->getEntityType(), "e");
	
		$expr = $builder->expr();
	
		$where = $expr->orX();
		foreach ($names as $name) {
			$where->add($expr->eq('LOWER (e.name)', $expr->literal($name)));
		}
		
		$builder->where($where);
	
		return $builder->getQuery();
	}
	
	public function findAssignedIds($articleId, $ids) {
		$items = $this->queryAssignedIds($articleId, $ids)->getScalarResult();
		return $this->getIds($items);
	}
	
	protected function queryAssignedIds($articleId, $ids) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$builder->select('IDENTITY (e.tag) AS id');
		$builder->from(ArticleTagAssignment::class, "e");
	
		$expr = $builder->expr();
	
		$where = $expr->andX();
		$where->add($expr->in('e.article', $articleId));
		$where->add($expr->in('e.tag', $ids));
		
		$builder->where($where);
	
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Tag::class;
	}
}
