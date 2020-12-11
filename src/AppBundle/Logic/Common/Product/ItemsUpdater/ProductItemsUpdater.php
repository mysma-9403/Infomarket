<?php

namespace AppBundle\Logic\Common\Product\ItemsUpdater;

use AppBundle\Repository\Base\BaseRepository;

class ProductItemsUpdater {

	/**
	 *
	 * @var BaseRepository
	 */
	private $productScoreRepository;

	/**
	 *
	 * @var ItemsUpdater
	 */
	private $productScoresUpdater;

	/**
	 *
	 * @var BaseRepository
	 */
	private $categorySummaryRepository;

	/**
	 *
	 * @var ItemsUpdater
	 */
	private $categorySummariesUpdater;

	/**
	 *
	 * @var BaseRepository
	 */
	private $productNoteRepository;

	/**
	 *
	 * @var ItemsUpdater
	 */
	private $productNotesUpdater;

	public function __construct(BaseRepository $productScoreRepository, ItemsUpdater $productScoresUpdater, 
			BaseRepository $categorySummaryRepository, ItemsUpdater $categorySummariesUpdater, 
			BaseRepository $productNoteRepository, ItemsUpdater $productNotesUpdater) {
		$this->productScoreRepository = $productScoreRepository;
		$this->productScoresUpdater = $productScoresUpdater;
		
		$this->categorySummaryRepository = $categorySummaryRepository;
		$this->categorySummariesUpdater = $categorySummariesUpdater;
		
		$this->productNoteRepository = $productNoteRepository;
		$this->productNotesUpdater = $productNotesUpdater;
	}

	public function updateProductItems($start) {
		$result = [];
		$result['productScores'] = $this->updateProductScores($start);
		$result['categorySummaries'] = $this->updateCategorySummaries($start);
		$result['productNotes'] = $this->updateProductNotes($start);
		
		return $result;
	}

	private function updateProductScores($start) {
		$items = $this->productScoreRepository->findBy(['upToDate' => false]);
		return $this->productScoresUpdater->update($start, $items);
	}

	private function updateCategorySummaries($start) {
		$items = $this->categorySummaryRepository->findBy(['upToDate' => false]);
		return $this->categorySummariesUpdater->update($start, $items);
	}

	private function updateProductNotes($start) {
		$items = $this->productNoteRepository->findBy(['upToDate' => false]);
		return $this->productNotesUpdater->update($start, $items);
	}
}