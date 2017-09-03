<?php

namespace Tests\AppBundle\Form\Filter\Admin\Assignments;

use AppBundle\Filter\Common\Assignments\MenuMenuEntryAssignmentFilter;
use AppBundle\Form\Filter\Admin\Assignments\MenuMenuEntryAssignmentFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class MenuMenuEntryAssignmentFilterTypeTest extends BaseFilterTypeTest {
		
	const MENU_1 = 101;
	const MENU_2 = 102;
	const MENU_3 = 103;
	const MENU_CHOICES = [self::MENU_1, self::MENU_2, self::MENU_3];
	const MENU_SELECTED = [self::MENU_1, self::MENU_3];
	
	const MENU_ENTRY_1 = 201;
	const MENU_ENTRY_2 = 202;
	const MENU_ENTRY_3 = 203;
	const MENU_ENTRY_CHOICES = [self::MENU_ENTRY_1, self::MENU_ENTRY_2, self::MENU_ENTRY_3];
	const MENU_ENTRY_SELECTED = [self::MENU_ENTRY_2, self::MENU_ENTRY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var MenuMenuEntryAssignmentFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertArray(self::MENU_SELECTED, $entity->getMenus());
		$this->assertArray(self::MENU_ENTRY_SELECTED, $entity->getMenuEntries());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['menus'] = self::MENU_SELECTED;
		$data['menuEntries'] = self::MENU_ENTRY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('menus')] = self::MENU_CHOICES;
		$options[self::getChoicesName('menuEntries')] = self::MENU_ENTRY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MenuMenuEntryAssignmentFilterType::class;
	}
	
	protected function getEntity() {
		return new MenuMenuEntryAssignmentFilter();
	}
}