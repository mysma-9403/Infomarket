<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Manager\Entity\Common\Main\ArchivedArticleManager;

class ArchivedArticleController extends ArticleController {
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(ArchivedArticleManager::class);
	}

	protected function getEntityName() {
		return 'archived_article';
	}
}