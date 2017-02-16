<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\ArticleBrandAssignment;

class BrandRepository extends BaseRepository
{
	//TODO the same as in IM - make inheritance
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
		$where->add($expr->eq('e.infoprodukt', 1));
	
		$builder->where($where);
	
		$builder->orderBy('e.name');
	
		return $builder->getQuery();
	}
	
	public function findTopItems($category) {
		return $this->queryTopItems($category)->getScalarResult();
	}
	
	protected function queryTopItems($category)
	{
		$builder = new QueryBuilder($this->getEntityManager());
			
		$builder->select("e.id, e.name, e.image, e.vertical");
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
	
		$builder->innerJoin(BrandCategoryAssignment::class, 'bca', Join::WITH, 'e.id = bca.brand');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = bca.category');
		
		$expr = $builder->expr();
		
		$where = $expr->andX();		
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $category . '#%')));
	
		$builder->where($where);
		
		return $builder->getQuery();
	}
	
	
	
    /**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Brand::class ;
	}
}
