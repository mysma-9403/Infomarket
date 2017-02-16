<?php

namespace AppBundle\Manager\Entity\Infomarket;

use AppBundle\Entity\Brand;
use AppBundle\Manager\Entity\Common\ArticleManager as CommonArticleManager;
use AppBundle\Repository\Infomarket\ArticleRepository;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Entity\Tag;
use AppBundle\Repository\Infomarket\TagRepository;

class ArticleManager extends CommonArticleManager {
	
	protected function getRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$type = $this->getEntityType();
		$metadata = $em->getClassMetadata($type);
	
		return new ArticleRepository($em, $metadata);
	}
	
	protected function getBrandRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$metadata = $em->getClassMetadata(Brand::class);
	
		return new BrandRepository($em, $metadata);
	}
	
	protected function getTagRepository() {
		/** @var ObjectManager $em */
		$em = $this->doctrine->getManager();
		$metadata = $em->getClassMetadata(Tag::class);
	
		return new TagRepository($em, $metadata);
	}
}