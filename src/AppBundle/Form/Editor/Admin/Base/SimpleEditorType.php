<?php

namespace AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\Simple;

class SimpleEditorType extends BaseEditorType {

	protected function getEntityType() {
		return Simple::class;
	}
}