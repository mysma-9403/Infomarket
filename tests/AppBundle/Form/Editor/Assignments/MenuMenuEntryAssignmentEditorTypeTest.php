<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Menu;
use AppBundle\Entity\MenuMenuEntryAssignment;
use AppBundle\Entity\MenuEntry;
use AppBundle\Form\Editor\Assignments\MenuMenuEntryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class MenuMenuEntryAssignmentEditorTypeTest extends TypeTestCase {
		
	const MENU_ID = 100;
	const MENU_NAME = 'Test menu';
	
	const MENU_ENTRY_ID = 100;
	const MENU_ENTRY_NAME = 'Test menuEntry';
	
	const ORDER_NUMBER = 7;
	
	const FORM_DATA = [
			'menu' => self::MENU_ID,
			'menuEntry' => self::MENU_ENTRY_ID,
			'orderNumber' => self::ORDER_NUMBER
	];
	
	const FORM_MENU_LIST = ['Test menu' => self::MENU_ID];
	const FORM_MENU_ENTRY_LIST = ['Test menuEntry' => self::MENU_ENTRY_ID];
	
	const FORM_OPTIONS = [
			'menu' => self::FORM_MENU_LIST,
			'menuEntry' => self::FORM_MENU_ENTRY_LIST
	];
	
	
	
	private $menuTransformer;
	
	private $menuEntryTransformer;
	
	
	
	protected function setUp() {
		$this->menuTransformer = $this->getMenuTransformerMock();
		$this->menuEntryTransformer = $this->getMenuEntryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MenuMenuEntryAssignmentEditorType($this->menuTransformer, $this->menuEntryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(MenuMenuEntryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new MenuMenuEntryAssignment();
		$form = $this->factory->create(MenuMenuEntryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::MENU_ID, $assignment->getMenu()->getId());
		$this->assertSame(self::MENU_NAME, $assignment->getMenu()->getName());
		$this->assertSame(self::MENU_ENTRY_ID, $assignment->getMenuEntry()->getId());
		$this->assertSame(self::MENU_ENTRY_NAME, $assignment->getMenuEntry()->getName());
		$this->assertSame(self::ORDER_NUMBER, $assignment->getOrderNumber());
	}
	
	
	
	private function getMenuTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getMenu());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MENU_ID);
	
		return $mock;
	}
	
	private function getMenuEntryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getMenuEntry());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MENU_ID);
	
		return $mock;
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