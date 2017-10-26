<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\ArticleCategoryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class ArticleCategoryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ArticleCategoryAssignment::class);
	}
}