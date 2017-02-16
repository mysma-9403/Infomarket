<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\CategoryManager as CommonCategoryManager;
use AppBundle\Repository\Search\Infoprodukt\CategorySearchRepository;

class SearchManager extends CommonCategoryManager {
	
	protected function getRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$type = $this->getEntityType();
		$metadata = $em->getClassMetadata($type);
	
		return new CategorySearchRepository($em, $metadata);
	}
}