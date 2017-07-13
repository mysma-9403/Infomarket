<?php

namespace Tests\AppBundle\Form\Editor\Base;


use AppBundle\Entity\Base\Audit;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use Tests\AppBundle\Form\Base\EditorTypeTest;

class BaseEntityEditorTypeTest extends EditorTypeTest {
	
	protected function getFormType() {
		return BaseEntityEditorType::class;
	}
	
	protected function getEntity() {
		return new Audit();
	}
}