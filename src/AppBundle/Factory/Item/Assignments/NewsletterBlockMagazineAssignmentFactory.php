<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockMagazineAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterBlockMagazineAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterBlockMagazineAssignment::class);
	}
}