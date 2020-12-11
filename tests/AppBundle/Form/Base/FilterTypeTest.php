<?php

namespace Tests\AppBundle\Form\Base;

abstract class FilterTypeTest extends BaseTypeTest {

	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['search'] = 'search';
		$actions['clear'] = 'clear';
		
		return $actions;
	}
}