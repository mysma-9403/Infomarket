<?php

namespace Tests\AppBundle\Form\Base;

abstract class ListTypeTest extends BaseTypeTest {
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['selectAll'] = 'selectAll';
		$actions['selectNone'] = 'selectNone';
		$actions['deleteSelected'] = 'deleteSelected';
				
		return $actions;
	}
}