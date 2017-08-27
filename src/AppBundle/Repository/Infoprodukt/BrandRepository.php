<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class BrandRepository extends BaseRepository {

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		
		return $fields;
	}
	
	// TODO the same as in IM - make inheritance
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

	protected function queryTopItems($category) {
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
	
	// TODO the same as in IM - make inheritance
	public function findRecommendedItems($categoryId) {
		return $this->queryRecommendedItems($categoryId)->getScalarResult();
	}

	protected function queryRecommendedItems($categoryId) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$expr = $builder->expr();
		
		$builder->select('e.id, e.name, e.image, e.forcedWidth, e.forcedHeight, e.vertical, e.mimeType');
		$builder->distinct();
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(Product::class, 'p', Join::WITH, 'e.id = p.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'p.id = pca.product');
		$builder->innerJoin(Category::class, 'c', Join::WITH, 'c.id = pca.category');
		
		$where = $expr->andX();
		$where->add($expr->eq('e.infomarket', 1));
		$where->add($expr->like('c.treePath', $expr->literal('%-' . $categoryId . '#%')));
		
		$builder->where($where);
		
		$builder->orderBy('e.name');
		
		return $builder->getQuery();
	}

	protected function getEntityType() {
		return Brand::class;
	}
}
