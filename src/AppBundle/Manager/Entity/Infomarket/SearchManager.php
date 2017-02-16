<?php

namespace AppBundle\Manager\Entity\Infomarket;

use AppBundle\Manager\Entity\Common\CategoryManager as CommonCategoryManager;
use AppBundle\Repository\Search\Infomarket\CategorySearchRepository;

class SearchManager extends CommonCategoryManager {
	
	protected function getRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$type = $this->getEntityType();
		$metadata = $em->getClassMetadata($type);
	
		return new CategorySearchRepository($em, $metadata);
	}
}