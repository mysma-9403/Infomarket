<?php

namespace AppBundle\Factory\Item\Assignments;

use AppBundle\Entity\Assignments\MenuMenuEntryAssignment;
use AppBundle\Factory\Item\Base\ItemFactory;

class MenuMenuEntryAssignmentFactory extends ItemFactory {

	public function __construct() {
		parent::__construct(MenuMenuEntryAssignment::class);
	}
}