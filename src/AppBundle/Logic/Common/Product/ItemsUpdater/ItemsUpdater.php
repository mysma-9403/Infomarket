<?php

namespace AppBundle\Logic\Common\Product\ItemsUpdater;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Logic\Common\Product\ItemUpdater\ItemUpdater;

class ItemsUpdater {

	/**
	 *
	 * @var ObjectManager
	 */
	private $em;

	/**
	 *
	 * @var ItemUpdater
	 */
	private $itemUpdater;

	/**
	 *
	 * @var integer
	 */
	private $duration;

	public function __construct(ObjectManager $em, ItemUpdater $itemUpdater, $duration) {
		$this->em = $em;
		$this->itemUpdater = $itemUpdater;
		$this->duration = $duration;
	}

	public function update(\DateTime $start, array $items) {
		$total = count($items);
		$done = 0;
		
		foreach ($items as $item) {
			$this->itemUpdater->update($item);
			$done ++;
			
			if ($this->shouldFinish($start)) {
				break;
			}
		}
		
		$this->em->flush();
		return ['total' => $total, 'done' => $done];
	}

	private function shouldFinish(\DateTime $start) {
		$end = new \DateTime();
		$interval = $end->getTimestamp() - $start->getTimestamp();
		return $interval > $this->duration;
	}
}