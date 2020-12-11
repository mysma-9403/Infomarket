<?php

namespace AppBundle\Repository\Admin\Other;

use AppBundle\Entity\Other\ProductScore;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Repository\Logic\ProductNote\DependentItemsRepository;

class ProductScoreRepository extends BaseRepository implements DependentItemsRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO product_scores (product_category_assignment_id, up_to_date) 
			VALUES (?, 0)";

	public function createFrom(array $items) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($items as $item) {
			$stmt->bindValue(1, $item['id']);
			$stmt->execute();
		}
	}

	protected function getEntityType() {
		return ProductScore::class;
	}
}
