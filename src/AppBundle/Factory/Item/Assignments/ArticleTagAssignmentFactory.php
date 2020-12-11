<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\ArticleTagAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class ArticleTagAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ArticleTagAssignment::class);
	}
}