<?php

namespace Tests\AppBundle\Form\Base;

abstract class EditorTypeTest extends BaseTypeTest {
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['save'] = 'save';
				
		return $actions;
	}
}