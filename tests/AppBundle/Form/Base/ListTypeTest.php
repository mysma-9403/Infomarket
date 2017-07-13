<?php

namespace Tests\AppBundle\Form\Base;

abstract class ListTypeTest extends BaseTypeTest {
	
	//TODO should be tested somehow
	
	protected function getFormFieldsCount() {
		return parent::getFormFieldsCount() + 3;
	}
}