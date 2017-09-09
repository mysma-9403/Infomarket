<?php

namespace Tests\AppBundle\Form\Editor\Admin\Base;

use AppBundle\Entity\Base\Simple;
use AppBundle\Form\Editor\Admin\Base\SimpleEditorType;

class SimpleEditorTypeTest extends BaseEditorTypeTest {

	protected function getFormType() {
		return SimpleEditorType::class;
	}

	protected function getEntity() {
		return new Simple();
	}
}