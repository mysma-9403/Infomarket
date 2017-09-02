<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Admin\Main\NewsletterGroupRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserEntryParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var NewsletterGroupRepository
	 */
	protected $newsletterGroupRepository;

	public function __construct(EntityManager $em, FilterManager $fm, NewsletterGroupRepository $newsletterGroupRepository) {
		parent::__construct($em, $fm);
		
		$this->newsletterGroupRepository = $newsletterGroupRepository;
	}

	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		
		$viewParams['newsletterGroups'] = $this->newsletterGroupRepository->findItemsByNewsletterUser($entry->getId());
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}