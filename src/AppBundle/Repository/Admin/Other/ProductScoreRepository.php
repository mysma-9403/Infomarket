<?php

namespace AppBundle\Repository\Admin\Other;

use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Entity\Other\ProductScore;
use AppBundle\Repository\Base\BaseRepository;

class ProductScoreRepository extends BaseRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO product_scores (product_category_assignment_id, up_to_date) 
			VALUES (?, 0)";

	public function createItems($productCategoryAssignments) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($productCategoryAssignments as $productCategoryAssignment) {
			$stmt->bindValue(1, $productCategoryAssignment['id']);
			$stmt->execute();
		}
	}

	protected function getEntityType() {
		return ProductScore::class;
	}
}
