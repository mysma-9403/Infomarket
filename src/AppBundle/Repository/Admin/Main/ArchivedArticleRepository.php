<?php

namespace AppBundle\Repository\Admin\Main;

class ArchivedArticleRepository extends ArticleRepository {

	public function __construct($em, $class) {
		parent::__construct($em, $class);
		
		$this->archived = true;
	}
}
