<?php

namespace AppBundle\Manager\Params\EntryParams\Admin;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Manager\Params\EntryParams\Base\EntryParamsManager;
use AppBundle\Repository\Admin\Main\NewsletterGroupRepository;
use Symfony\Component\HttpFoundation\Request;

class NewsletterUserEntryParamsManager extends EntryParamsManager {
	
	public function getShowParams(Request $request, array $params, $id) {
		$params = parent::getShowParams($request, $params, $id);
		$viewParams = $params['viewParams'];
		
		$entry = $viewParams['entry'];
	
		$em = $this->doctrine->getManager();
		
		$newsletterGroupRepository = new NewsletterGroupRepository($em, $em->getClassMetadata(NewsletterGroup::class));
		$viewParams['newsletterGroups'] = $newsletterGroupRepository->findItemsByNewsletterUser($entry->getId());
		
		$params['viewParams'] = $viewParams;
		return $params;
	}
}