<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Link;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;

class LinkManager extends SimpleEntityManager {
	
	protected function getEntityType() {
		return Link::class;
	}
}