<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\NewsletterBlockArticleAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class NewsletterBlockArticleAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(NewsletterBlockArticleAssignment::class);
	}
}