<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Tag;
use AppBundle\Form\Editor\Admin\Main\TagEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class TagEditorTypeTest extends SimpleEditorTypeTest {
	
	protected function getFormType() {
		return TagEditorType::class;
	}
	
	protected function getEntity() {
		return new Tag();
	}
}