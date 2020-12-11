<?php

namespace AppBundle\Logic\Common\Product\ItemsUpdater;

use AppBundle\Logic\Common\Product\ItemUpdater\ItemUpdater;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Repository\Base\BaseRepository;

class ItemsUpdater {

	/**
	 *
	 * @var ObjectManager
	 */
	private $em;

	/**
	 *
	 * @var BaseRepository
	 */
	private $repository;

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

	/**
	 *
	 * @var integer
	 */
	private $packSize;

	public function __construct(ObjectManager $em, BaseRepository $repository, ItemUpdater $itemUpdater, 
			$duration, $packSize) {
		$this->em = $em;
		$this->repository = $repository;
		$this->itemUpdater = $itemUpdater;
		$this->duration = $duration;
		$this->packSize = $packSize;
	}
	
	public function update(\DateTime $start, array $items) {
		$total = count($items);
		$done = 0;
		
		while (true) {
			if ($this->shouldFinish($start)) {
				break;
			}
			
			$items = $this->repository->findBy(['upToDate' => false], null, $this->packSize);
			
			if (count($items) <= 0) {
				break;
			}
			
			foreach ($items as $item) {
				$this->itemUpdater->update($item);
				$done ++;
			}
				
			$this->em->flush();
			$this->em->clear();
		}
		
		return ['total' => $total, 'done' => $done];
	}

	private function shouldFinish(\DateTime $start) {
		$end = new \DateTime();
		$interval = $end->getTimestamp() - $start->getTimestamp();
		return $interval > $this->duration;
	}
}