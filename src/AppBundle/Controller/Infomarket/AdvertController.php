<?php

namespace AppBundle\Controller\Infomarket;

use AppBundle\Controller\Base\DummyController;
use AppBundle\Entity\Main\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends DummyController {
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	public function clickAction(Request $request, $id, $replaceScheme) {
		return $this->clickActionInternal($request, $id, $replaceScheme);
	}
	
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	protected function clickActionInternal(Request $request, $id, $replaceScheme) {
		$am = $this->getAnalyticsManager();
		$am->sendEventAnalytics($this->getEntityName(), 'click', $id);
		
		$entry = $this->getEntry($id);
		$entry->setClickCount($entry->getClickCount() + 1);
		
		$this->saveEntry($entry);
		
		if ($replaceScheme == 1) {
			$scheme = $request->getScheme() . '://';
			
			$link = $entry->getLink();
			$link = str_replace('http://', '', $link);
			$link = str_replace('https://', '', $link);
			
			return $this->redirect($scheme . $link);
		}
		
		return $this->redirect($entry->getLink());
	}

	protected function saveEntry($entry) {
		$em = $this->getDoctrine()->getManager();
		
		$em->persist($entry);
		$em->flush();
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	protected function getEntityType() {
		return Advert::class;
	}
	
	// -----------------------------------------------------------------
	// Domain
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @return string domain - base part of the route
	 */
	protected function getDomain() {
		return 'infomarket';
	}
}
