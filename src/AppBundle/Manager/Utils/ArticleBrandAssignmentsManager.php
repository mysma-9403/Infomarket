<?php

namespace AppBundle\Manager\Utils;

use AppBundle\Entity\Main\Article;

class ArticleBrandAssignmentsManager extends AssignmentsManager {

	public function __construct() {
		parent::__construct('article', 'brands');
	}
}