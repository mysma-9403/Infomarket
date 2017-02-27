<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Repository\Admin\Other\SendNewsletterRepository;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterGroup;

class NewsletterPageEntryParamsManager extends EntryParamsManager {
	
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
		
		$newsletterGroupRepository = $this->doctrine->getRepository(NewsletterGroup::class);
		$viewParams['newsletterGroups'] = $newsletterGroupRepository->findItemsByIds($sendNewsletterFilter->getNewsletterGroups());
		
		$em = $this->doctrine->getManager();
		
		$sendNewsletterRepository = new SendNewsletterRepository($em, $em->getClassMetadata(NewsletterUser::class));
		$viewParams['recipients'] = $sendNewsletterRepository->findItems($sendNewsletterFilter);
		
		$params['viewParams'] = $viewParams;
    	return $params;
	}
}