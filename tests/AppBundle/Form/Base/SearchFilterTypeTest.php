<?php

namespace Tests\AppBundle\Form\Base;

use AppBundle\Form\Base\SearchFilterType;
use AppBundle\Filter\Common\Search\SearchFilter;

class SearchFilterTypeTest extends BaseTypeTest {
	
	const SEARCH_STRING = 'Some search string';
	
	protected function assertEntity($entity) {
		/** @var SearchFilter $entity */
		$this->assertSame(self::SEARCH_STRING, $entity->getString());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['string'] = self::SEARCH_STRING;
		
		return $data;
	}
	
	protected function getFormActions() {
		$actions = parent::getFormActions();
		
		$actions['search'] = 'search';
				
		return $actions;
	}
	
	protected function getFormType() {
		return SearchFilterType::class;
	}
	
	protected function getEntity() {
		return new SearchFilter();
	}
}