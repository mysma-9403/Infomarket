<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\CategorySummary;
use AppBundle\Repository\Base\BaseRepository;

class CategorySummaryRepository extends BaseRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO category_summaries (category_id, up_to_date) VALUES (?, 0)";

	const INVALIDATE_ITEMS_BY_CATEGORIES_SQL = "UPDATE category_summaries cs
			SET cs.up_to_date = 0 WHERE cs.category_id IN (?)";

	public function invalidateItemsByCategories($categories) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INVALIDATE_ITEMS_BY_CATEGORIES_SQL);
	
		$stmt->bindValue(1, join(", ", $categories));
		$stmt->execute();
	}
	
	public function createItems($categories) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($categories as $category) {
			$stmt->bindValue(1, $category['id']);
			$stmt->execute();
		}
	}

	protected function getEntityType() {
		return CategorySummary::class;
	}
}
