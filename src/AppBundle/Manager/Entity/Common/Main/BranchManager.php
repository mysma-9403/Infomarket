<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\Branch;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BranchManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var Branch $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setIcon($request->get('icon'));
		$entry->setColor($request->get('color'));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		$entry->setContent($request->get('content'));
		
		return $entry;
	}

	/**
	 *
	 * @param Branch $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Branch $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setIcon($template->getIcon());
		$entry->setColor($template->getColor());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		$entry->setContent($template->getContent());
		
		return $entry;
	}

	protected function getEntityType() {
		return Branch::class;
	}
}