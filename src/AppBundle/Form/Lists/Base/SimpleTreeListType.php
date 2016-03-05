<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Base\SimpleTree;

class SimpleTreeListType extends SimpleEntityListType
{	
	/**
	 * Get listed entitys' type.
	 *
	 * @return mixed (e.g <strong>Product::class</strong>)
	 */
	protected function getChoiceType() {
		return SimpleTree::class;
	}
}