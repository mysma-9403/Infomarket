<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\Link;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Entity\Main\Page;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

class MenuEntryManager extends EntityManager {

	/**
	 *
	 * @var ParamsManager
	 */
	protected $paramsManager;

	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager) {
		parent::__construct($repository, $paginator);
		$this->paramsManager = $paramsManager;
	}

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var MenuEntry $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setParent($this->paramsManager->getParamByName($request, MenuEntry::class, 'parent'));
		
		$entry->setPage($this->paramsManager->getParamByClass($request, Page::class));
		$entry->setLink($this->paramsManager->getParamByClass($request, Link::class));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}

	/**
	 *
	 * @param MenuEntry $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var MenuEntry $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setParent($template->getParent());
		
		$entry->setPage($template->getPage());
		$entry->setLink($template->getLink());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}

	protected function getEntityType() {
		return MenuEntry::class;
	}
}