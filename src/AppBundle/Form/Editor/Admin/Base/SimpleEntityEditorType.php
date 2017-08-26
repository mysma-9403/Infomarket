<?php

namespace AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\SimpleEntity;

class SimpleEntityEditorType extends BaseEntityEditorType {

	protected function getEntityType() {
		return SimpleEntity::class;
	}
}