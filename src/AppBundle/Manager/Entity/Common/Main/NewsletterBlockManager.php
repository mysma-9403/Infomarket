<?php

namespace AppBundle\Manager\Entity\Common\Main;

use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Manager\Entity\Base\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

class NewsletterBlockManager extends EntityManager {

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
		/** @var NewsletterBlock $entry */
		$entry = parent::createFromRequest($request);
		
		$entry->setSubname($request->get('name'));
		$entry->setSubname($request->get('subname'));
		
		$entry->setNewsletterBlockTemplate(
				$this->paramsManager->getParamByClass($request, NewsletterBlockTemplate::class));
		
		$entry->setNewsletterPage($this->paramsManager->getParamByClass($request, NewsletterPage::class));
		
		$entry->setOrderNumber($request->get('order_number', 99));
		
		$entry->setXAdvertRatio($request->get('x_advert_ratio', 1));
		$entry->setYAdvertRatio($request->get('y_advert_ratio', 1));
		
		$entry->setXArticleRatio($request->get('x_article_ratio', 1));
		$entry->setYArticleRatio($request->get('y_article_ratio', 1));
		
		$entry->setXMagazineRatio($request->get('x_magazine_ratio', 1));
		$entry->setYMagazineRatio($request->get('y_magazine_ratio', 1));
		
		$entry->setMagazinePadding($request->get('magazine_padding', 3));
		
		return $entry;
	}

	/**
	 *
	 * @param NewsletterBlock $template        	
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Manager\Entity\Base\EntityManager::createFromTemplate()
	 */
	public function createFromTemplate($template) {
		/** @var NewsletterBlock $entry */
		$entry = parent::createFromTemplate($template);
		
		$entry->setName($template->getName());
		$entry->setSubname($template->getSubname());
		
		$entry->setNewsletterBlockTemplate($template->getNewsletterBlockTemplate());
		$entry->setNewsletterPage($template->getNewsletterPage());
		
		$entry->setOrderNumber($template->getOrderNumber());
		$entry->setXAdvertRatio($template->getXAdvertRatio());
		$entry->setYAdvertRatio($template->getYAdvertRatio());
		
		$entry->setXArticleRatio($template->getXArticleRatio());
		$entry->setYArticleRatio($template->getYArticleRatio());
		
		$entry->setXMagazineRatio($template->getXMagazineRatio());
		$entry->setYMagazineRatio($template->getYMagazineRatio());
		
		$entry->setMagazinePadding($template->getMagazinePadding());
		
		return $entry;
	}

	protected function getEntityType() {
		return NewsletterBlock::class;
	}
}