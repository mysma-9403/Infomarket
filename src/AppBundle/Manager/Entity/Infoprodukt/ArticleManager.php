<?php

namespace AppBundle\Manager\Entity\Infoprodukt;

use AppBundle\Manager\Entity\Common\Main\ArticleManager as CommonArticleManager;
use AppBundle\Repository\Infoprodukt\BrandRepository;
use AppBundle\Repository\Infoprodukt\TagRepository;
use AppBundle\Manager\Utils\ArticleBrandAssignmentsManager;
use AppBundle\Manager\Utils\ArticleTagAssignmentsManager;
use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Manager\Params\Base\ParamsManager;

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
	
	public function __construct(BaseRepository $repository, $paginator, ParamsManager $paramsManager,
			BrandRepository $brandRepository,
			TagRepository $tagRepository,
			ArticleBrandAssignmentsManager $abaManager,
			ArticleTagAssignmentsManager $ataManager) {
	
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