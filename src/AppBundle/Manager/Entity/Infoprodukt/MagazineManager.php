<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\MagazineManager as CommonMagazineManager;
use AppBundle\Repository\Infoprodukt\MagazineRepository;

class MagazineManager extends CommonMagazineManager {
	
	protected function getRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$type = $this->getEntityType();
		$metadata = $em->getClassMetadata($type);
	
		return new MagazineRepository($em, $metadata);
	}
}