<?php

namespace Tests\AppBundle\Form\Lists;

use Tests\AppBundle\Form\Lists\Base\BaseListTypeTest;
use AppBundle\Form\Lists\BenchmarkMessageListType;

class BenchmarkMessageListTypeTest extends BaseListTypeTest {
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['setReadSelected'] = 'setReadSelected';
		$actions['setUnreadSelected'] = 'setUnreadSelected';
				
		return $actions;
	}
	
	protected function getFormType() {
		return BenchmarkMessageListType::class;
	}
}