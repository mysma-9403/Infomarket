<?php

namespace AppBundle\Manager\Filter\Admin;

use AppBundle\Entity\Filter\ArticleFilter;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Manager\Filter\Common\ArticleFilterManager;

class ArchivedArticleFilterManager extends ArticleFilterManager {
	
	public function adaptToView(BaseEntityFilter $filter, array $params) {
		/** @var ArticleFilter $filter */
		$filter = parent::adaptToView($filter, $params);
		 
		$filter->setArchived(BaseEntityFilter::TRUE_VALUES);
		
		return $filter;
	}
}