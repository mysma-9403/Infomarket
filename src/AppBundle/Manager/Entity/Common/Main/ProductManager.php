<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Product;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

class ProductManager extends EntityManager {

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
		/** @var Product $entry */
		
		$entry->setName($request->get('name'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		
		$entry->setBrand($this->paramsManager->getParamByClass($request, Brand::class));
		
		$entry->setPrice($request->get('price'));
		
		return $entry;
	}

	/**
	 *
	 * @param Product $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Product $entry */
		
		$entry->setName($template->getName());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		
		$entry->setBrand($template->getBrand());
		
		$entry->setPrice($template->getPrice());
		
		return $entry;
	}

	protected function getEntityType() {
		return Product::class;
	}
}