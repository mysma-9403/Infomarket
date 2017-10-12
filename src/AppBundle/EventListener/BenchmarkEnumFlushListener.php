<?php

namespace AppBundle\EventListener;

use Doctrine\ORM\Event\OnFlushEventArgs;
use AppBundle\Repository\Admin\Main\ProductNoteRepository;
use AppBundle\Entity\Main\ProductNote;

class BenchmarkEnumFlushListener {
	
	public function onFlush(OnFlushEventArgs $eventArgs) {
		$em = $eventArgs->getEntityManager();
		$uow = $em->getUnitOfWork();
		$updatedEntities = $uow->getScheduledEntityUpdates();
		
		$productNoteRepository = new ProductNoteRepository($em, $em->getClassMetadata(ProductNote::class));
		
		foreach ($updatedEntities as $entity) {
			$changes = $uow->getEntityChangeSet($entity);
			
			if(key_exists('name', $changes)) {
				$ids = $productNoteRepository->findIdsByEnumValues($changes['name']);
				if(count($ids) > 0) $productNoteRepository->invalidateItems($ids);
			} else if(key_exists('value', $changes)) {
				$ids = $productNoteRepository->findIdsByEnumValues([$entity->getName()]);
				if(count($ids) > 0) $productNoteRepository->invalidateItems($ids);
			}
		}
	}
}