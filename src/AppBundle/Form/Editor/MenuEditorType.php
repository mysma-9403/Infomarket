<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Menu;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;

class MenuEditorType extends SimpleEntityEditorType
{	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Menu::class;
	}
}