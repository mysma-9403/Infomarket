<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\NewsletterPage;
use AppBundle\Entity\NewsletterPageTemplate;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

class NewsletterPageManager extends EntityManager {

	/**
	 *
	 * @var ParamsManager
	 */
	protected $paramsManager;

	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager) {
		parent::__construct($repository, $paginator);
		$this->paramsManager = $paramsManager;
	}

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var NewsletterPage $entry */
		
		$entry->setName($request->get('name'));
		$entry->setSubname($request->get('subname'));
		
		$entry->setNewsletterPageTemplate($this->paramsManager->getParamByClass($request, NewsletterPageTemplate::class));
		
		return $entry;
	}

	/**
	 *
	 * @param NewsletterPage $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var NewsletterPage $entry */
		
		$entry->setName($template->getName());
		$entry->setSubname($template->getSubname());
		
		$entry->setNewsletterPageTemplate($template->getNewsletterPageTemplate());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterPage::class;
	}
}