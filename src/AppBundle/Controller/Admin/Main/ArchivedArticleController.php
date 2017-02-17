<?php

namespace AppBundle\Controller\Admin\Main;


use AppBundle\Manager\Entity\Admin\ArchivedArticleManager;

class ArchivedArticleController extends ArticleController {
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		$tokenStorage = $this->get('security.token_storage');
		return new ArchivedArticleManager($doctrine, $paginator, $tokenStorage);
	}
	
	protected function getEntityName() {
		return 'archived_article';
	}
}