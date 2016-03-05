<?php

namespace AppBundle\Form\Lists\Base;

use AppBundle\Entity\Base\ImageEntity;

class ImageEntityListType extends SimpleEntityListType
{	
	/**
	 * Get listed entitys' type.
	 *
	 * @return mixed (e.g <strong>Product::class</strong>)
	 */
	protected function getChoiceType() {
		return ImageEntity::class;
	}
}