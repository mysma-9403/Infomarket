<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Segment;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class SegmentManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var Segment $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setColor($request->get('color'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}

	/**
	 *
	 * @param Segment $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Segment $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setColor($template->getColor());
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}

	protected function getEntityType() {
		return Segment::class;
	}
}