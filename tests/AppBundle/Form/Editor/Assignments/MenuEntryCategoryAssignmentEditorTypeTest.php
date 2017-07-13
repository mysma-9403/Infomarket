<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\MenuEntryCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class MenuEntryCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const MENU_ENTRY_ID = 100;
	const MENU_ENTRY_NAME = 'Test menuEntry';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'menuEntry' => self::MENU_ENTRY_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_MENU_ENTRY_LIST = ['Test menuEntry' => self::MENU_ENTRY_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'menuEntry' => self::FORM_MENU_ENTRY_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $menuEntryTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->menuEntryTransformer = $this->getMenuEntryTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MenuEntryCategoryAssignmentEditorType($this->menuEntryTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(MenuEntryCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new MenuEntryCategoryAssignment();
		$form = $this->factory->create(MenuEntryCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::MENU_ENTRY_ID, $assignment->getMenuEntry()->getId());
		$this->assertSame(self::MENU_ENTRY_NAME, $assignment->getMenuEntry()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getMenuEntryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getMenuEntry());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MENU_ENTRY_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MENU_ENTRY_ID);
	
		return $mock;
	}
	
	
	private function getMenuEntry() {
		$mock = new MenuEntry();
		$mock->setId(self::MENU_ENTRY_ID);
		$mock->setName(self::MENU_ENTRY_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}