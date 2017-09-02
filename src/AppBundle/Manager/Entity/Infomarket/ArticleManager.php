<?php

namespace AppBundle\Manager\Entity\Infomarket;

use AppBundle\Manager\Entity\Common\Main\ArticleManager as CommonArticleManager;
use AppBundle\Manager\Params\Base\ParamsManager;
use AppBundle\Manager\Utils\ArticleBrandAssignmentsManager;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Repository\Infomarket\BrandRepository;
use AppBundle\Repository\Infomarket\TagRepository;
use AppBundle\Manager\Utils\ArticleTagAssignmentsManager;

class ArticleManager extends CommonArticleManager {

	/**
	 *
	 * @var BrandRepository
	 */
	protected $brandRepository;

	/**
	 *
	 * @var TagRepository
	 */
	protected $tagRepository;

	/**
	 *
	 * @var ArticleBrandAssignmentsManager
	 */
	protected $abaManager;

	/**
	 *
	 * @var ArticleTagAssignmentsManager
	 */
	protected $ataManager;

	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager, BrandRepository $brandRepository, TagRepository $tagRepository, ArticleBrandAssignmentsManager $abaManager, ArticleTagAssignmentsManager $ataManager) {
		parent::__construct($repository, $paginator, $paramsManager);
		
		$this->brandRepository = $brandRepository;
		$this->tagRepository = $tagRepository;
		
		$this->abaManager = $abaManager;
		$this->ataManager = $ataManager;
	}

	public function getEntries($filter, $page) {
		$items = parent::getEntries($filter, $page);
		
		if (count($items) > 0) {
			$ids = $this->repository->getIds($items);
			
			$brands = $this->brandRepository->findItemsByArticles($ids);
			$items = $this->abaManager->assignToItems($items, $brands);
			
			$tags = $this->tagRepository->findItemsByArticles($ids);
			$items = $this->ataManager->assignToItems($items, $tags);
		}
		
		return $items;
	}
}