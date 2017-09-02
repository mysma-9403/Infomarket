<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkQueryManager extends EntityManager {

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var BenchmarkQuery $entry */
		
		$entry->setName($request->get('name'));
		$entry->setContent($request->getQueryString());
		
		return $entry;
	}

	/**
	 *
	 * @param BenchmarkQuery $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var BenchmarkQuery $entry */
		
		$entry->setName($template->getName());
		$entry->setContent($template->getContent());
		
		return $entry;
	}

	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
}