<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Admin\Main\NewsletterGroupRepository;
use AppBundle\Repository\Admin\Other\SendNewsletterRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterPageEntryParamsManager extends EntryParamsManager {

	/**
	 *
	 * @var NewsletterGroupRepository
	 */
	protected $newsletterGroupRepository;

	/**
	 *
	 * @var SendNewsletterRepository
	 */
	protected $sendNewsletterRepository;

	public function __construct(EntityManager $em, FilterManager $fm, NewsletterGroupRepository $newsletterGroupRepository, SendNewsletterRepository $sendNewsletterRepository) {
		parent::__construct($em, $fm);
		
		$this->newsletterGroupRepository = $newsletterGroupRepository;
		$this->sendNewsletterRepository = $sendNewsletterRepository;
	}

	public function getSendNewsletterFormParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$sendNewsletterFilter = new SendNewsletterFilter();
		$sendNewsletterFilter->initContextParams($contextParams);
		$sendNewsletterFilter->initRequestValues($request);
		
		$viewParams['sendNewsletterFilter'] = $sendNewsletterFilter;
		
		$params['viewParams'] = $viewParams;
		return $params;
	}

	public function getSendNewsletterListParams(Request $request, array $params) {
		return $this->getSendNewsletterParams($request, $params);
	}

	public function getSendNewsletterParams(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
		$contextParams['newsletterPage'] = $entry->getId();
		
		$sendNewsletterFilter = new SendNewsletterFilter();
		$sendNewsletterFilter->initContextParams($contextParams);
		$sendNewsletterFilter->initRequestValues($request);
		
		$viewParams['sendNewsletterFilter'] = $sendNewsletterFilter;
		
		$viewParams['newsletterGroups'] = $this->newsletterGroupRepository->findItemsByIds($sendNewsletterFilter->getNewsletterGroups());
		
		$viewParams['recipients'] = $this->sendNewsletterRepository->findItems($sendNewsletterFilter);
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}