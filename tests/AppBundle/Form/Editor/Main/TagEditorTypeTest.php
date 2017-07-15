<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\Tag;
use AppBundle\Form\Editor\Main\TagEditorType;
use Tests\AppBundle\Form\Editor\Base\SimpleEntityEditorTypeTest;

class TagEditorTypeTest extends SimpleEntityEditorTypeTest {
	
	protected function getFormType() {
		return TagEditorType::class;
	}
	
	protected function getEntity() {
		return new Tag();
	}
}