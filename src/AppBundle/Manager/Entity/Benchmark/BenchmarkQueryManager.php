<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Entity\BenchmarkQuery;
use AppBundle\Manager\Entity\Base\BaseEntityManager;
use AppBundle\Repository\Benchmark\BenchmarkQueryRepository;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkQueryManager extends BaseEntityManager {
	
	protected function getRepository() {
		$em = $this->doctrine->getManager();
		return new BenchmarkQueryRepository($em, $em->getClassMetadata(BenchmarkQuery::class));
	}
	
	/**
	 * Create new entry with request parameters.
	 * @param Request $request
	 * 
	 * @return BenchmarkQuery
	 */
	public function createFromRequest(Request $request) {
		$entry = new BenchmarkQuery();
		
		$entry->setName($request->get('name'));
		$entry->setContent($request->getQueryString());
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * @param BenchmarkQuery $template
	 * 
	 * @return BenchmarkQuery
	 */
	public function createFromTemplate($template) {
		/** @var BenchmarkQuery $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setName($template->getName());
		$entry->setContent($template->getContent());
		
		return $entry;
	}
	
	protected function getEntityType() {
		return BenchmarkQuery::class;
	}
}