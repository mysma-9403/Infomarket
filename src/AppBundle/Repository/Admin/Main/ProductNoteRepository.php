<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\ProductNote;
use AppBundle\Repository\Base\BaseRepository;

class ProductNoteRepository extends BaseRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO product_notes (product_category_assignment_id, up_to_date) VALUES (?, 0)";

	public function createItems($productCategoryAssignments) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($productCategoryAssignments as $productCategoryAssignment) {
			$stmt->bindValue(1, $productCategoryAssignment['id']);
			$stmt->execute();
		}
	}

	protected function getEntityType() {
		return ProductNote::class;
	}
}
