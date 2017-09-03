<?php

namespace Tests\AppBundle\Form\Editor\Admin\Base;


use AppBundle\Entity\Base\Simple;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use Tests\AppBundle\Form\Base\EditorTypeTest;

class BaseEditorTypeTest extends EditorTypeTest {
	
	protected function getFormType() {
		return BaseEditorType::class;
	}
	
	protected function getEntity() {
		return new Simple();
	}
}