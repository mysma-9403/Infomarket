<?php

namespace AppBundle\Repository\Infomarket;

use AppBundle\Entity\Product;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Brand;
use Doctrine\ORM\Query\Expr\Join;
use AppBundle\Entity\ProductCategoryAssignment;

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
		
		$where->add($expr->eq('e.infomarket', 1));
		$where->add($expr->eq('pca.category', $category));
		$where->add($expr->eq('pca.segment', $segment));
		
		$builder->where($where);
		
		$builder->addOrderBy('b.name', 'ASC');
		$builder->addOrderBy('e.name', 'ASC');
		
		return $builder->getQuery();
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 */
	protected function getEntityType() {
		return Product::class;
	}
}
