<?php

namespace AppBundle\Repository\Admin\Other;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Other\ProductValue;
use AppBundle\Repository\Base\BaseRepository;

class ProductValueRepository extends BaseRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO product_values (product_category_assignment_id) 
			VALUES (?)";

	public function createItems($productCategoryAssignments) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($productCategoryAssignments as $productCategoryAssignment) {
			$stmt->bindValue(1, $productCategoryAssignment['id']);
			$stmt->execute();
		}
	}

	protected function getEntityType() {
		return ProductValue::class;
	}
}
