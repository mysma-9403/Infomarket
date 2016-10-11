<?php

namespace AppBundle\Manager\Entity\Common;

use AppBundle\Entity\Tag;
use AppBundle\Manager\Entity\Base\SimpleEntityManager;

class TagManager extends SimpleEntityManager {
	
	protected function getEntityType() {
		return Tag::class;
	}
}