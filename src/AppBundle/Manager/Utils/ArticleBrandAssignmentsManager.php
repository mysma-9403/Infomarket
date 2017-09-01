<?php

namespace AppBundle\Manager\Utils;

use AppBundle\Entity\Article;

class ArticleBrandAssignmentsManager extends AssignmentsManager {
	
	public function __construct() {
		parent::__construct('article', 'brands');
	}
}