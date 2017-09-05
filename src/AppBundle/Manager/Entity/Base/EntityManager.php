<?php

namespace AppBundle\Manager\Entity\Base;

use AppBundle\Entity\Base\Simple;
use AppBundle\Repository\Base\BaseRepository;
use Doctrine\ORM\Query\Expr\Base;
use Symfony\Component\HttpFoundation\Request;

abstract class EntityManager {

	const DEFAULT_ENTRIES_PER_PAGE = 8;

	/**
	 *
	 * @var BaseRepository
	 */
	protected $repository;

	/**
	 *
	 * @var unknown
	 */
	protected $paginator;

	protected $entriesPerPage;

	public function __construct(BaseRepository $repository, $paginator) {
		$this->repository = $repository;
		$this->paginator = $paginator;
		$this->entriesPerPage = self::DEFAULT_ENTRIES_PER_PAGE;
	}

	public function setEntriesPerPage($entriesPerPage) {
		$this->entriesPerPage = $entriesPerPage;
	}

	/**
	 * Get object from the repository.
	 *
	 * @param integer $id        	
	 *
	 * @return Simple
	 */
	public function getEntry($id) {
		return $this->repository->find($id);
	}

	public function getEntries($filter, $page) {
		if ($this->entriesPerPage > 0) {
			$query = $this->repository->queryItems($filter);
			return $this->paginator->paginate($query, $page, $this->entriesPerPage);
		} else {
			return $this->repository->findItems($filter);
		}
	}

	/**
	 * Create new entry with request parameters.
	 *
	 * @param Request $request        	
	 *
	 * @return Simple
	 */
	public function createFromRequest(Request $request) {
		return $this->create();
	}

	/**
	 * Create new entry with template parameters.
	 *
	 * @param Simple $template        	
	 *
	 * @return Simple
	 */
	public function createFromTemplate($template) {
		return $this->create();
	}

	protected function create() {
		$refClass = new \ReflectionClass($this->getEntityType());
		return $refClass->newInstanceArgs();
	}

	protected abstract function getEntityType();
}