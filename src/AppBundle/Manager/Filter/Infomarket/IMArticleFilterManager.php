<?php

namespace AppBundle\Manager\Filter\Infomarket;

use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Common\ArticleFilterManager;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Filter\ArticleCategoryFilter;
use AppBundle\Entity\User;
use AppBundle\Repository\ArticleCategoryRepository;

class IMArticleFilterManager extends ArticleFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var ArticleFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setActive(BaseEntityFilter::TRUE_VALUES);
		
	if(count($filter->getArticleCategories()) == 0) {
			$userRepository = $this->doctrine->getRepository(User::class);
			/** @var ArticleCategoryRepository $articleCategoryRepository */
			$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
			
			/** @var ArticleCategoryFilter $articleCategoryFilter */
			$articleCategoryFilter = new ArticleCategoryFilter($userRepository);
			$articleCategoryFilter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
			
			$articleCategories = $articleCategoryRepository->findSelected($articleCategoryFilter);
			$filter->setArticleCategories($articleCategories);
		}
		
		return $filter;
	}
}