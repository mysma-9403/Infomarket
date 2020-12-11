<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\ArticleBrandAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class ArticleBrandAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(ArticleBrandAssignment::class);
	}
}