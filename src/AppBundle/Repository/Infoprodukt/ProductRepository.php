<?php

namespace AppBundle\Repository\Infoprodukt;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Filter\Base\Filter;

class ProductRepository extends BaseRepository {

	public function findTopItems($category, $segment) {
		return $this->queryTopItems($category, $segment)->getScalarResult();
	}

	protected function queryTopItems($category, $segment) {
		$builder = new QueryBuilder($this->getEntityManager());
		
		$builder->select('e.id, e.name, e.image, e.mimeType, e.vertical, e.forcedWidth, e.forcedHeight, pca.featured AS featured,
				b.id AS brandId, b.name AS brandName, b.www AS brandWww, b.image AS brandImage, b.mimeType AS brandMimeType,
				b.forcedWidth AS brandForcedWidth, b.forcedHeight AS brandForcedHeight, b.vertical AS brandVertical');
		$builder->from($this->getEntityType(), "e");
		
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
		$builder->innerJoin(ProductCategoryAssignment::class, 'pca', Join::WITH, 'e.id = pca.product');
		
		$expr = $builder->expr();
		
		$where = $expr->andX();
		
		$where->add($expr->eq('e.infoprodukt', 1));
		$where->add($expr->eq('pca.category', $category));
		$where->add($expr->eq('pca.segment', $segment));
		
		$builder->where($where);
		
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	protected function buildJoins(QueryBuilder &$builder, Filter $filter) {
		$builder->innerJoin(Brand::class, 'b', Join::WITH, 'b.id = e.brand');
	}

	protected function getSelectFields(QueryBuilder &$builder, Filter $filter) {
		$fields = parent::getSelectFields($builder, $filter);
		
		$fields[] = 'e.name';
		
		$fields[] = 'e.image';
		$fields[] = 'e.vertical';
		$fields[] = 'b.name AS brandName';
		
		return $fields;
	}

	protected function getWhere(QueryBuilder &$builder, Filter $filter) {
		$where = parent::getWhere($builder, $filter);
		
		$expr = $builder->expr();
		
		$where->add($expr->eq('e.infoprodukt', 1));
		
		return $where;
	}

	protected function getEntityType() {
		return Product::class;
	}
}
