<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Entity\MenuEntry;
use AppBundle\Form\Editor\Admin\Assignments\MenuMenuEntryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEntityEditorTypeTest;

class MenuMenuEntryAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const MENU_ID = 100;
	const MENU_NAME = 'Test menu';
	const MENU_CHOICES = ['Test menu' => self::MENU_ID];
	
	const MENU_ENTRY_ID = 100;
	const MENU_ENTRY_NAME = 'Test menuEntry';
	const MENU_ENTRY_CHOICES = ['Test menuEntry' => self::MENU_ENTRY_ID];
	
	const ORDER_NUMBER = 37;
	
	
	
	private $menuTransformer;
	
	private $menuEntryTransformer;
	
	
	
	protected function setUp() {
		$this->menuTransformer = $this->getEntityTransformerMock($this->getMenu(), self::MENU_ID);
		$this->menuEntryTransformer = $this->getEntityTransformerMock($this->getMenuEntry(), self::MENU_ENTRY_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MenuMenuEntryAssignmentEditorType($this->menuTransformer, $this->menuEntryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var MenuMenuEntryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::MENU_ID, $entity->getMenu()->getId());
		$this->assertSame(self::MENU_NAME, $entity->getMenu()->getName());
		
		$this->assertSame(self::MENU_ENTRY_ID, $entity->getMenuEntry()->getId());
		$this->assertSame(self::MENU_ENTRY_NAME, $entity->getMenuEntry()->getName());
		
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['menu'] = self::MENU_ID;
		$data['menuEntry'] = self::MENU_ENTRY_ID;
		
		$data['orderNumber'] = self::ORDER_NUMBER;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('menu')] = self::MENU_CHOICES;
		$options[self::getChoicesName('menuEntry')] = self::MENU_ENTRY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MenuMenuEntryAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new MenuMenuEntryAssignment();
	}
	
	
	
	private function getMenu() {
		$mock = new Menu();
		$mock->setId(self::MENU_ID);
		$mock->setName(self::MENU_NAME);
		
		return $mock;
	}
	
	private function getMenuEntry() {
		$mock = new MenuEntry();
		$mock->setId(self::MENU_ENTRY_ID);
		$mock->setName(self::MENU_ENTRY_NAME);
	
		return $mock;
	}
}