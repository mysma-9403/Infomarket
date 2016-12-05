<?php

namespace AppBundle\Manager\Entity\Base;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\Base\ParamsManager;
use Doctrine\ORM\Query\Expr\Base;
use AppBundle\Entity\Base\Audit;

abstract class EntityManager extends ParamsManager {
	
	protected $paginator;
	
	protected $entriesPerPage;
	
	/**
	 * 
	 * @param unknown $doctrine
	 */
	public function __construct($doctrine, $paginator) {
		parent::__construct($doctrine);
		
		$this->paginator = $paginator;
		$this->entriesPerPage = 8;
	}
	
	public function setEntriesPerPage($entriesPerPage) {
		$this->entriesPerPage = $entriesPerPage;
	}
	
	/**
	 * Get object from the repository.
	 * @param integer $id
	 * 
	 * @return Audit
	 */
	public function getEntry($id) {
		$repository = $this->getRepository();
		return $repository->find($id);
	}
	
	public function getEntries($filter, $page) {
		$repository = $this->getRepository();
		if($this->entriesPerPage > 0) {
			$query = $repository->querySelected($filter);
			return $this->paginator->paginate($query, $page, $this->entriesPerPage);
		} else {
			return $repository->findSelected($filter);
		}
	}
	
	protected function getRepository() {
		return $this->doctrine->getRepository($this->getEntityType());
	}
	
	/**
	 * Create new entry with request parameters.
	 * 
	 * @param Request $request
	 * 
	 * @return Audit
	 */
	public function createFromRequest(Request $request) {
		/** @var Audit $entry */
		$entry = $this->create(); 
		
		$entry->setPublished($request->get('published'));
		
		return $entry;
	}
	
	/**
	 * Create new entry with template parameters.
	 * 
	 * @param Audit $template
	 * 
	 * @return Audit
	 */
	public function createFromTemplate($template) {
		/** @var Audit $entry */
		$entry = $this->create(); 
		
		$entry->setPublished($template->getPublished());
		
		return $entry;
	}
	
	protected function create() {
		$refClass = new \ReflectionClass($this->getEntityType());
		return $refClass->newInstanceArgs();
	}
	
	protected abstract function getEntityType();
}