<?php

namespace Tests\AppBundle\Form\Filter\Admin\Main;

use AppBundle\Filter\Common\Main\MenuEntryFilter;
use AppBundle\Form\Filter\Admin\Main\MenuEntryFilterType;
use Tests\AppBundle\Form\Filter\Admin\Base\BaseFilterTypeTest;

class MenuEntryFilterTypeTest extends BaseFilterTypeTest {
		
	const NAME = '*name*';
	
	const INFOMARKET_FALSE = 0;
	const INFOMARKET_TRUE = 1;
	const INFOMARKET_ALL = 2;
	const INFOMARKET_CHOICES = [self::INFOMARKET_FALSE, self::INFOMARKET_TRUE, self::INFOMARKET_ALL];
	const INFOMARKET_SELECTED = self::INFOMARKET_TRUE;
	
	const INFOPRODUKT_FALSE = 0;
	const INFOPRODUKT_TRUE = 1;
	const INFOPRODUKT_ALL = 2;
	const INFOPRODUKT_CHOICES = [self::INFOPRODUKT_FALSE, self::INFOPRODUKT_TRUE, self::INFOPRODUKT_ALL];
	const INFOPRODUKT_SELECTED = self::INFOPRODUKT_TRUE;
	
	const MENU_1 = 101;
	const MENU_2 = 102;
	const MENU_3 = 103;
	const MENU_CHOICES = [self::MENU_1, self::MENU_2, self::MENU_3];
	const MENU_SELECTED = [self::MENU_2, self::MENU_3];
	
	const MENU_ENTRY_1 = 201;
	const MENU_ENTRY_2 = 202;
	const MENU_ENTRY_3 = 203;
	const MENU_ENTRY_CHOICES = [self::MENU_ENTRY_1, self::MENU_ENTRY_2, self::MENU_ENTRY_3];
	const MENU_ENTRY_SELECTED = [self::MENU_ENTRY_2, self::MENU_ENTRY_3];
	
	const BRANCH_1 = 301;
	const BRANCH_2 = 302;
	const BRANCH_3 = 303;
	const BRANCH_CHOICES = [self::BRANCH_1, self::BRANCH_2, self::BRANCH_3];
	const BRANCH_SELECTED = [self::BRANCH_2, self::BRANCH_3];
	
	const CATEGORY_1 = 401;
	const CATEGORY_2 = 402;
	const CATEGORY_3 = 403;
	const CATEGORY_CHOICES = [self::CATEGORY_1, self::CATEGORY_2, self::CATEGORY_3];
	const CATEGORY_SELECTED = [self::CATEGORY_2, self::CATEGORY_3];
	
	
	
	protected function assertEntity($entity) {
		/** @var MenuEntryFilter $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET_SELECTED, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT_SELECTED, $entity->getInfoprodukt());
		
		$this->assertArray(self::MENU_SELECTED, $entity->getMenus());
		$this->assertArray(self::MENU_ENTRY_SELECTED, $entity->getParents());
		$this->assertArray(self::BRANCH_SELECTED, $entity->getBranches());
		$this->assertArray(self::CATEGORY_SELECTED, $entity->getCategories());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET_SELECTED;
		$data['infoprodukt'] = self::INFOPRODUKT_SELECTED;
		
		$data['menus'] = self::MENU_SELECTED;
		$data['parents'] = self::MENU_ENTRY_SELECTED;
		$data['branches'] = self::BRANCH_SELECTED;
		$data['categories'] = self::CATEGORY_SELECTED;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('infomarket')] = self::INFOMARKET_CHOICES;
		$options[self::getChoicesName('infoprodukt')] = self::INFOPRODUKT_CHOICES;
		
		$options[self::getChoicesName('menus')] = self::MENU_CHOICES;
		$options[self::getChoicesName('parents')] = self::MENU_ENTRY_CHOICES;
		$options[self::getChoicesName('branches')] = self::BRANCH_CHOICES;
		$options[self::getChoicesName('categories')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MenuEntryFilterType::class;
	}
	
	protected function getEntity() {
		return new MenuEntryFilter();
	}
}