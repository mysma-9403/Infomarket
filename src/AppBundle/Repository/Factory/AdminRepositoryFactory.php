<?php

namespace AppBundle\Repository\Factory;

use AppBundle\Entity\NewsletterUser;
use AppBundle\Repository\Admin\Other\SendNewsletterRepository;
use Doctrine\Common\Persistence\ObjectManager;

class InfomarketRepositoryFactory {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	public function __construct(ObjectManager $em) {
		$this->em = $em;
	}

	public function getRepository($class) {
		if ($class == SendNewsletterRepository::class) {
			return new SendNewsletterRepository($this->em, $this->em->getClassMetadata(NewsletterUser::class));
		}
		
		return null;
	}
}