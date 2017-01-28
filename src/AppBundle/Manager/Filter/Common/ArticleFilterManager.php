<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseEntityFilterManager;

class ArticleFilterManager extends BaseEntityFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var ArticleFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		 
		$filter->setArchived(BaseEntityFilter::FALSE_VALUES);
		$filter->setActive(BaseEntityFilter::TRUE_VALUES);
		$filter->setMain(BaseEntityFilter::TRUE_VALUES);
		$filter->setOrderBy('e.date DESC');
		
		return $filter;
	}
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$articleCategoryRepository = $this->doctrine->getRepository(ArticleCategory::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$brandRepository = $this->doctrine->getRepository(Brand::class);
		$tagRepository = $this->doctrine->getRepository(Tag::class);
	
		return new ArticleFilter($userRepository, $articleCategoryRepository, $categoryRepository, $brandRepository, $tagRepository);
	}
}