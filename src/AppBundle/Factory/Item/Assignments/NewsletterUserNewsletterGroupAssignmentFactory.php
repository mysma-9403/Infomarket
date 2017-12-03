<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterUserNewsletterGroupAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterUserNewsletterGroupAssignment::class);
	}
}