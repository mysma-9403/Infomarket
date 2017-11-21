<?php

namespace AppBundle\Manager\Persistence\Main;

use AppBundle\Entity\Main\Category;
use AppBundle\Manager\Persistence\Base\PersistenceManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Admin\Main\CategoryRepository;
use Doctrine\ORM\EntityManager;

class CategoryManager extends PersistenceManager {

	/**
	 *
	 * @var CategoryRepository
	 */
	protected $repository;

	public function __construct(EntityManager $em, CategoryRepository $repository) {
		parent::__construct($em);
		$this->repository = $repository;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Persistence\Base\PersistenceManager::saveMore()
	 *
	 * @param Category $item        	
	 */
	protected function saveMore(Request $request, $item, array $params) {
		$parent = $item->getParent();
		if ($parent) {
			$rootId = $parent->getRootId();
			if (! $rootId)
				$rootId = $parent->getId();
			
			$items = $this->repository->findChildrenIds($item->getId(), $rootId);
			
			if (count($items) > 0) {
				$this->repository->setRootId($items, $rootId);
			}
		} else {
			$items = $this->repository->findChildrenIds($item->getId(), $item->getId());
			
			if (count($items) > 0) {
				$this->repository->setRootId($items, $item->getId());
			}
		}
	}
}