<?php

namespace Tests\AppBundle\Form\Base;

abstract class EditorTypeTest extends BaseTypeTest {
	
	protected function getFormFieldsCount() {
		return parent::getFormFieldsCount() + 1;
	}
}