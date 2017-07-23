<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Admin\Assignments\MenuEntryCategoryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\MenuEntryCategoryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseEntityFilterTypeTest;

class MenuEntryCategoryAssignmentFilterTypeTest extends BaseEntityFilterTypeTest {
		
	const MENU_ENTRY_1 = 101;
	const MENU_ENTRY_2 = 102;
	const MENU_ENTRY_3 = 103;
	const MENU_ENTRY_CHOICES = [self::MENU_ENTRY_1, self::MENU_ENTRY_2, self::MENU_ENTRY_3];
	const MENU_ENTRY_SELECTED = [self::MENU_ENTRY_1, self::MENU_ENTRY_3];
	
	const CATEGORY_1 = 201;
	const CATEGORY_2 = 202;
	const CATEGORY_3 = 203;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var MenuEntryCategoryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::MENU_ENTRY_SELECTED, $entity->getMenuEntries());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['menuEntries'] = self::MENU_ENTRY_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('menuEntries')] = self::MENU_ENTRY_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MenuEntryCategoryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new MenuEntryCategoryAssignmentFilter();
	}
}