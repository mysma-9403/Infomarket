<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Tag;
use AppBundle\Form\Editor\Admin\Main\TagEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEntityEditorTypeTest;

class TagEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	protected function getFormType() {
		return TagEditorType::class;
	}
	
	protected function getEntity() {
		return new Tag();
	}
}