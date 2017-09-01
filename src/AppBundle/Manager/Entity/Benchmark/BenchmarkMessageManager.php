<?php

namespace AppBundle\Manager\Entity\Benchmark;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Entity\Product;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Repository\Benchmark\BenchmarkMessageRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

class BenchmarkMessageManager extends EntityManager {
	
	/**
	 * 
	 * @var ParamsManager
	 */
	protected $paramsManager;
	
	/**
	 * 
	 * @var unknown
	 */
	protected $tokenStorage;
	
	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager, $tokenStorage) {
		parent::__construct($repository, $paginator);
		
		$this->paramsManager = $paramsManager;
		$this->tokenStorage = $tokenStorage;
	}
	
	protected function getRepository() {
		$em = $this->doctrine->getManager();
		return new BenchmarkMessageRepository($em, $em->getClassMetadata(BenchmarkMessage::class));
	}
	
	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var BenchmarkMessage $entry */
		
		$entry->setName($request->get('name'));
		$entry->setContent($request->get('content'));
		
		$entry->setProduct($this->paramsManager->getParamByClass($request, Product::class));
		
		$entry->setAuthor($this->tokenStorage->getToken()->getUser());
		
		$entry->setState(BenchmarkMessage::REPORTED_STATE);
		
		$entry->setReadByAdmin(false);
		$entry->setReadByAuthor(false);
		
		return $entry;
	}
	
	/**
	 *
	 * @param BenchmarkMessage $template
	 *
	 * {@inheritDoc}
	 * 
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var BenchmarkMessage $entry */
		
		$entry->setName($template->getName());
		$entry->setContent($template->getContent());
		
		$entry->setProduct($template->getProduct());
		
		$entry->setAuthor($this->tokenStorage->getToken()->getUser());
		
		$entry->setState(BenchmarkMessage::REPORTED_STATE);
		
		$entry->setReadByAdmin(false);
		$entry->setReadByAuthor(false);
		
		return $entry;
	}
	
	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}