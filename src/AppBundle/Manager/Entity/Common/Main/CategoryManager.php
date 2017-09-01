<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Category;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Base\BaseRepository;

class CategoryManager extends EntityManager {

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
		/** @var Category $entry */
		
		$entry->setName($request->get('name'));
		$entry->setSubname($request->get('subname'));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		$entry->setFeatured($request->get('featured'));
		
		$entry->setBenchmark($request->get('benchmark'));
		$entry->setPreleaf($request->get('preleaf'));
		
		$entry->setParent($this->paramsManager->getParamByName($request, Category::class, 'parent'));
		
		$entry->setFeaturedImage($request->get('featured_image'));
		
		$entry->setIcon($request->get('icon'));
		
		$entry->setContent($request->get('content'));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}

	/**
	 *
	 * @param Category $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Category $entry */
		
		$entry->setName($template->getName());
		$entry->setSubname($template->getSubname());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		$entry->setFeatured($template->getFeatured());
		
		$entry->setBenchmark($template->getBenchmark());
		$entry->setPreleaf($template->getPreleaf());
		
		$entry->setParent($template->getParent());
		
		$entry->setFeaturedImage($template->getFeaturedImage());
		
		$entry->setIcon($template->getIcon());
		
		$entry->setContent($template->getContent());
		
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}

	protected function getEntityType() {
		return Category::class;
	}
}