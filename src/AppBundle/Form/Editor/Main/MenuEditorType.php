<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Menu;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;

class MenuEditorType extends SimpleEntityEditorType //TODO useless >> make some Controller that not needs Editor
{	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Menu::class;
	}
}