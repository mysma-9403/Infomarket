<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\ProductNote;
use AppBundle\Repository\Admin\Main\ProductNoteRepository;
use Doctrine\ORM\Event\OnFlushEventArgs;

class BenchmarkFieldFlushListener {

	public function onFlush(OnFlushEventArgs $eventArgs) {
		$em = $eventArgs->getEntityManager();
		$uow = $em->getUnitOfWork();
		$updatedEntities = $uow->getScheduledEntityUpdates();
		
		$productNoteRepository = new ProductNoteRepository($em, $em->getClassMetadata(ProductNote::class));
		
		/** @var BenchmarkField $entity */
		foreach ($updatedEntities as $entity) {
			$changes = $uow->getEntityChangeSet($entity);
			
			if (key_exists('category', $changes)) {
				$categories = $changes['category'];
				$productNoteRepository->invalidateItemsByCategories($categories);
			} else if (key_exists('fieldType', $changes) || key_exists('valueNumber', $changes) ||
					 key_exists('noteType', $changes) || key_exists('noteWeight', $changes)) {
				$categories = [$entity->getCategory()->getId()];
				$productNoteRepository->invalidateItemsByCategories($categories);
			}
		}
	}
}