<?php

namespace AppBundle\Manager\Entity\Infomarket;

use AppBundle\Manager\Entity\Common\BrandManager as CommonBrandManager;
use AppBundle\Repository\Infomarket\BrandRepository;

class BrandManager extends CommonBrandManager {
	
	protected function getRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$type = $this->getEntityType();
		$metadata = $em->getClassMetadata($type);
	
		return new BrandRepository($em, $metadata);
	}
}