<?php

namespace AppBundle\Manager\Entity\Admin;

use AppBundle\Repository\Admin\Main\ArchivedArticleRepository;

class ArchivedArticleManager extends ArticleManager {
	
	protected function getRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$type = $this->getEntityType();
		$metadata = $em->getClassMetadata($type);
	
		return new ArchivedArticleRepository($em, $metadata);
	}
}