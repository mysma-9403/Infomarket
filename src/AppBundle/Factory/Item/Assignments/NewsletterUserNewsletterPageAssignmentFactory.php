<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\NewsletterUserNewsletterPageAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterUserNewsletterPageAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterUserNewsletterPageAssignment::class);
	}
}