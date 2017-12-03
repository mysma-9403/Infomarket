<?php

namespace AppBundle\Repository\Admin\Other;

use AppBundle\Entity\Other\ProductValue;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Repository\Logic\ProductNote\DependentItemsRepository;

class ProductValueRepository extends BaseRepository implements DependentItemsRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO product_values (product_category_assignment_id) VALUES (?)";

	public function createFrom(array $items) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($items as $item) {
			$stmt->bindValue(1, $item['id']);
			$stmt->execute();
		}
	}

	protected function getEntityType() {
		return ProductValue::class;
	}
}
