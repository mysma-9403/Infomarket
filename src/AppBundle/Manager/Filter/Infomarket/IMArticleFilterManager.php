<?php

namespace AppBundle\Manager\Filter\Infomarket;

use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Common\ArticleFilterManager;

class IMArticleFilterManager extends ArticleFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var ArticleFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setActive(BaseEntityFilter::TRUE_VALUES);
		
		if(count($filter->getArticleCategories()) == 0) {
			$filter->setInfomarket(BaseEntityFilter::TRUE_VALUES);
		}
		
		return $filter;
	}
}