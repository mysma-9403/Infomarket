<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Base\ImageTree;

class ImageTreeListType extends ImageEntityListType
{	
	/**
	 * Get listed entitys' type.
	 *
	 * @return mixed (e.g <strong>Product::class</strong>)
	 */
	protected function getChoiceType() {
		return ImageTree::class;
	}
}