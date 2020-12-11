<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Lists\BaseList;
use AppBundle\Form\Base\ListType;

class BaseListType extends ListType {

	protected function getEntityType() {
		return BaseList::class;
	}
}