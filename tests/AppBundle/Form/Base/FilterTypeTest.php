<?php

namespace Tests\AppBundle\Form\Base;

abstract class FilterTypeTest extends BaseTypeTest {
	
	protected function getFormFieldsCount() {
		return parent::getFormFieldsCount() + 2;
	}
}