<?php

namespace AppBundle\Manager\Filter\Infoprodukt;

use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Common\ArticleFilterManager;

class IPArticleFilterManager extends ArticleFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var ArticleFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		
		$filter->setActive(BaseEntityFilter::TRUE_VALUES);
		
		return $filter;
	}
}