<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\ArticleArticleCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class ArticleArticleCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ArticleArticleCategoryAssignment::class);
	}
}