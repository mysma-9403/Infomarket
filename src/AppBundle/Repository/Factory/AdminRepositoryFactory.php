<?php

namespace AppBundle\Repository\Factory;

use AppBundle\Entity\Main\Article;
use AppBundle\Entity\Main\NewsletterUser;
use AppBundle\Repository\Admin\Main\ArchivedArticleRepository;
use AppBundle\Repository\Admin\Other\SendNewsletterRepository;
use Doctrine\Common\Persistence\ObjectManager;

class AdminRepositoryFactory {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	public function __construct(ObjectManager $em) {
		$this->em = $em;
	}

	public function getRepository($class) {
		if ($class == ArchivedArticleRepository::class) {
			return new ArchivedArticleRepository($this->em, $this->em->getClassMetadata(Article::class));
		}
		
		if ($class == SendNewsletterRepository::class) {
			return new SendNewsletterRepository($this->em, $this->em->getClassMetadata(NewsletterUser::class));
		}
		
		return null;
	}
}