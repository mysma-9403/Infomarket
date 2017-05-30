<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\BenchmarkEnum;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkEnumManager extends BaseEntityManager {
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return BenchmarkEnum
	 */
	public function createFromRequest(Request $request) {
		$entry = new BenchmarkEnum();
		
		$entry->setName($request->get('name'));
		$entry->setValue($request->get('value'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param BenchmarkEnum $template
	 * 
	 * @return BenchmarkEnum
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