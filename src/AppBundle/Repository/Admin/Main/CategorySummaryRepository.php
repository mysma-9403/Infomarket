<?php

namespace AppBundle\Repository\Admin\Main;

use AppBundle\Entity\Main\CategorySummary;
use AppBundle\Repository\Base\BaseRepository;

class CategorySummaryRepository extends BaseRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO category_summaries (category_id, up_to_date) VALUES (?, 0)";
	
	const UPDATE_ITEM_SQL = "UPDATE category_summaries SET";
	
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
