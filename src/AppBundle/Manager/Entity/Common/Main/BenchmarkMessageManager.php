<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Entity\Product;

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

	public function createFromRequest(Request $request) {
		$entry = new BenchmarkMessage();
		
		$entry->setName($request->get('name'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setAuthor($this->tokenStorage->getToken()->getUser());
		
		$entry->setProduct($this->paramsManager->getParamByClass($request, Product::class));
		
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
		/** @var BenchmarkMessage $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setName($template->getName());
		
		$entry->setContent($template->getContent());
		
		$entry->setAuthor($this->tokenStorage->getToken()->getUser());
		
		$entry->setProduct($template->getProduct());
		
		$entry->setState(BenchmarkMessage::REPORTED_STATE);
		
		$entry->setReadByAdmin(false);
		$entry->setReadByAuthor(false);
		
		return $entry;
	}

	protected function getEntityType() {
		return BenchmarkMessage::class;
	}
}