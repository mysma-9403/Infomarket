<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\Article;
use AppBundle\Manager\Entity\Base\EntityManager;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Repository\Base\BaseRepository;
use Symfony\Component\HttpFoundation\Request;

class ArticleManager extends EntityManager {

	/**
	 *
	 * @var ParamsManager
	 */
	protected $paramsManager;
	
	// TODO common manager shouldn't use admin repository
	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager) {
		parent::__construct($repository, $paginator);
		
		$this->paramsManager = $paramsManager;
	}

	public function createFromRequest(Request $request) {
		$entry = parent::createFromRequest($request);
		/** @var Article $entry */
		
		$entry->setName($request->get('name'));
		$entry->setSubname($request->get('subname'));
		
		$entry->setShowTitle($request->get('show_title', true));
		
		$entry->setInfomarket($request->get('infomarket'));
		$entry->setInfoprodukt($request->get('infoprodukt'));
		$entry->setFeatured($request->get('featured'));
		
		$entry->setIntro($request->get('intro'));
		$entry->setContent($request->get('content'));
		
		$entry->setDate($request->get('date', new \DateTime()));
		$entry->setEndDate($request->get('end_date'));
		
		$entry->setLayout($request->get('layout', Article::LEFT_LAYOUT));
		$entry->setImageSize($request->get('image_size', Article::MEDIUM_IMAGE));
		
		$entry->setParent($this->paramsManager->getParamByName($request, Article::class, 'parent'));
		
		$entry->setPage($request->get('order_number', 1));
		$entry->setOrderNumber($request->get('order_number', 99));
		
		return $entry;
	}

	/**
	 *
	 * @param Article $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		$entry = parent::createFromTemplate($template);
		/** @var Article $entry */
		
		$entry->setName($template->getName());
		$entry->setSubname($template->getSubname());
		
		$entry->setShowTitle($template->getShowTitle());
		
		$entry->setInfomarket($template->getInfomarket());
		$entry->setInfoprodukt($template->getInfoprodukt());
		$entry->setFeatured($template->getFeatured());
		
		$entry->setIntro($template->getIntro());
		$entry->setContent($template->getContent());
		
		$entry->setAuthor($template->getAuthor());
		$entry->setDate($template->getDate());
		
		$entry->setLayout($template->getLayout());
		$entry->setImageSize($template->getImageSize());
		
		$entry->setParent($template->getParent());
		
		$entry->setPage($template->getPage());
		$entry->setOrderNumber($template->getOrderNumber());
		
		return $entry;
	}

	protected function getEntityType() {
		return Article::class;
	}
}