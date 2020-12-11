<?php

namespace AppBundle\Repository\Admin\Other;

use AppBundle\Entity\Other\CategorySummary;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Repository\Logic\ProductNote\DependentItemsRepository;

class CategorySummaryRepository extends BaseRepository implements DependentItemsRepository {

	const INSERT_ITEMS_SQL = "INSERT INTO category_summaries (category_id, up_to_date) VALUES (?, 0)";

	const INVALIDATE_ITEMS_BY_CATEGORIES_SQL = "UPDATE category_summaries cs
			SET cs.up_to_date = 0 WHERE cs.category_id IN (?)";

	public function invalidateItemsByCategories($categories) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INVALIDATE_ITEMS_BY_CATEGORIES_SQL);
		
		$stmt->bindValue(1, join(", ", $categories));
		$stmt->execute();
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Repository\Logic\ProductNote\DependentItemsRepository::createFrom()
	 */
	public function createFrom(array $items) {
		$conn = $this->getEntityManager()->getConnection();
		$stmt = $conn->prepare(self::INSERT_ITEMS_SQL);
		
		foreach ($items as $item) {
			$stmt->bindValue(1, $item['id']);
			$stmt->execute();
		}
	}
	
	protected function getEntityType() {
		return CategorySummary::class;
	}
}
