<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\BenchmarkEnum;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkEnumManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = new BenchmarkEnum();
		
		$entry->setName($request->get('name'));
		$entry->setValue($request->get('value'));
		
		return $entry;
	}

	/**
	 *
	 * @param BenchmarkEnum $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		/** @var BenchmarkEnum $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setName($template->getName());
		$entry->setValue($template->getValue());
		
		return $entry;
	}

	protected function getEntityType() {
		return BenchmarkEnum::class;
	}
}