<?php

namespace AppBundle\Manager\Utils;

use AppBundle\Entity\Article;

class ArticleTagAssignmentsManager extends AssignmentsManager {

	public function __construct() {
		parent::__construct('article', 'tags');
	}
}