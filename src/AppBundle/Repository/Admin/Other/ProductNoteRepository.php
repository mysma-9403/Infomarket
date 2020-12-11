<?php

namespace AppBundle\Repository\Admin\Other;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Other\ProductNote;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Repository\Logic\ProductNote\DependentItemsRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;

class ProductNoteRepository extends BaseRepository implements DependentItemsRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO product_notes (product_category_assignment_id, up_to_date) 
			VALUES (?, 0)";

	const INVALIDATE_ITEMS_BY_CATEGORIES_SQL = "UPDATE product_notes pn
			JOIN product_category_assignments pca ON pn.product_category_assignment_id = pca.id
			SET pn.up_to_date = 0 WHERE pca.category_id IN (?)";
	
	// TODO wrong!!
	public function findIdsByEnumValues($enumValues) {
		$items = $this->queryIdsByEnumValues($enumValues)->getScalarResult();
		return $this->getIds($items);
	}

	protected function queryIdsByEnumValues($enumValues) {
		$builder = new QueryBuilder($this->getEntityManager());
		$builder->select('e.id');
		$builder->from(ProductNote::class, 'e');
		$builder->join(ProductCategoryAssignment::class, 'pca', Join::WITH, 
				'pca.id = e.productCategoryAssignment');
		$builder->join(Product::class, 'p', Join::WITH, 'pca.product = p.id');
		
		$expr = $builder->expr();
		
		$where = $expr->orX();
		foreach ($enumValues as $enumValue) {
			$where->add($expr->like('p.string7', "'%" . $enumValue . "%'"));
		}
		$builder->where($where);
		
		return $builder->getQuery();
	}

	public function invalidateItemsByCategories($categories) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INVALIDATE_ITEMS_BY_CATEGORIES_SQL);
		
		$stmt->bindValue(1, join(", ", $categories));
		$stmt->execute();
	}

	public function createFrom(array $items) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($items as $item) {
			$stmt->bindValue(1, $item['id']);
			$stmt->execute();
		}
	}

	protected function getEntityType() {
		return ProductNote::class;
	}
}
