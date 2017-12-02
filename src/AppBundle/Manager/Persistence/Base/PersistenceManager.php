<?php

namespace AppBundle\Manager\Persistence\Base;

use AppBundle\Entity\Base\Simple;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class PersistenceManager {

	/**
	 *
	 * @var ObjectManager
	 */
	protected $em;

	/**
	 *
	 * @param EntityManager $em        	
	 */
	public function __construct(EntityManager $em) {
		$this->em = $em;
	}

	/**
	 *
	 * @param Request $request        	
	 * @param Simple $item        	
	 * @param array $params        	
	 */
	public function saveItem(Request $request, $item, array $params) {
		$persistent = $this->getPersistentItem($item);
		$this->em->persist($item);
		$this->em->flush();
		
		$this->saveMore($request, $item, $persistent, $params);
		$this->em->flush();
	}

	/**
	 *
	 * @param Request $request        	
	 * @param Simple $item        	
	 * @param array $params        	
	 */
	protected function saveMore(Request $request, $item, $persistent, array $params) {
	}

	/**
	 *
	 * @param Request $request        	
	 * @param Simple $item        	
	 * @param array $params        	
	 */
	public function deleteItem(Request $request, $item, array $params) {
		$this->deleteMore($request, $item, $params);
		
		$this->em->remove($item);
		$this->em->flush();
	}

	public function deleteItems(Request $request, array $items, array $params) {
		foreach ($items as $item) {
			$this->deleteMore($request, $item, $params);
			$this->em->remove($item);
		}
		$this->em->flush();
	}

	/**
	 *
	 * @param Request $request        	
	 * @param Simple $item        	
	 * @param array $params        	
	 */
	protected function deleteMore(Request $request, $item, array $params) {
	}

	private function getPersistentItem($item) {
		return $this->em->getUnitOfWork()->getOriginalEntityData($item);
	}
}