<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Brand;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\BrandCategoryAssignment;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\ArticleBrandAssignment;

class BrandRepository extends BaseRepository
{	
	public function findItemsByArticles($articlesIds) {
		return $this->queryItemsByArticles($articlesIds)->getScalarResult();
	}
	
	protected function queryItemsByArticles($articlesIds) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select('e.id, e.name, IDENTITY(aba.article) AS article');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(ArticleBrandAssignment::class, 'aba', Join::WITH, 'e.id = aba.brand');
		
		$where = $expr->andX();
		$where->add($expr->in('aba.article', $articlesIds));
		$where->add($expr->eq('e.infomarket', 1));
		
		$builder->where($where);
		
		$builder->orderBy('e.name');
		
		return $builder->getQuery();
	}
	
	public function findTopItems($categoryId) {
		return $this->queryTopItems($categoryId)->getScalarResult();
	}
	
	protected function queryTopItems($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
	
		$expr = $builder->expr();
	
		$builder->select('e.id, e.name, e.image');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(BrandCategoryAssignment::class, 'bca', Join::WITH, 'e.id = bca.brand');
		
		$where = $expr->andX();
		$where->add($expr->eq('bca.category', $categoryId));
		$where->add($expr->eq('e.infomarket', 1));
	
		$builder->where($where);
		
		$builder->orderBy('e.name');
	
		return $builder->getQuery();
	}
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class ;
	}
}
