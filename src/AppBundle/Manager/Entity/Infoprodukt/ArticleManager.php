<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\ArticleManager as CommonArticleManager;
use AppBundle\Repository\Infoprodukt\ArticleRepository;

class ArticleManager extends CommonArticleManager {
	
	protected function getRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$type = $this->getEntityType();
		$metadata = $em->getClassMetadata($type);
	
		return new ArticleRepository($em, $metadata);
	}
}