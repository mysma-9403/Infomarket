<?php

namespace AppBundle\Manager\Utils;

use AppBundle\Entity\Main\Article;

class ArticleTagAssignmentsManager extends AssignmentsManager {

	public function __construct() {
		parent::__construct('article', 'tags');
	}
}