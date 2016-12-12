<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Manager\Filter\Admin\ArchivedArticleFilterManager;

class ArchivedArticleController extends ArticleController {
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getFilterManager($doctrine) {
		return new ArchivedArticleFilterManager($doctrine);
	}
	
	protected function getEntityName() {
		return 'archived_article';
	}
}