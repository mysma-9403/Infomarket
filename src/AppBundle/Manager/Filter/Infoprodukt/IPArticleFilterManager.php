<?php

namespace AppBundle\Manager\Filter\Infoprodukt;

use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Common\ArticleFilterManager;
use AppBundle\Entity\Filter\ArticleCategoryFilter;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\User;

class IPArticleFilterManager extends ArticleFilterManager {
	
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
			$articleCategoryFilter->setInfoprodukt(BaseEntityFilter::TRUE_VALUES);
			
			$articleCategories = $articleCategoryRepository->findSelected($articleCategoryFilter);
			$filter->setArticleCategories($articleCategories);
		}
		
		return $filter;
	}
}