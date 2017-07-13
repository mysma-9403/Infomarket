<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Entity\Branch;
use AppBundle\Form\Editor\Assignments\MenuEntryBranchAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class MenuEntryBranchAssignmentEditorTypeTest extends TypeTestCase {
		
	const MENU_ENTRY_ID = 100;
	const MENU_ENTRY_NAME = 'Test menuEntry';
	
	const BRANCH_ID = 100;
	const BRANCH_NAME = 'Test branch';
	
	const FORM_DATA = [
			'menuEntry' => self::MENU_ENTRY_ID,
			'branch' => self::BRANCH_ID
	];
	
	const FORM_MENU_ENTRY_LIST = ['Test menuEntry' => self::MENU_ENTRY_ID];
	const FORM_BRANCH_LIST = ['Test branch' => self::BRANCH_ID];
	
	const FORM_OPTIONS = [
			'menuEntry' => self::FORM_MENU_ENTRY_LIST,
			'branch' => self::FORM_BRANCH_LIST
	];
	
	
	
	private $menuEntryTransformer;
	
	private $branchTransformer;
	
	
	
	protected function setUp() {
		$this->menuEntryTransformer = $this->getMenuEntryTransformerMock();
		$this->branchTransformer = $this->getBranchTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MenuEntryBranchAssignmentEditorType($this->menuEntryTransformer, $this->branchTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(MenuEntryBranchAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new MenuEntryBranchAssignment();
		$form = $this->factory->create(MenuEntryBranchAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::MENU_ENTRY_ID, $assignment->getMenuEntry()->getId());
		$this->assertSame(self::MENU_ENTRY_NAME, $assignment->getMenuEntry()->getName());
		$this->assertSame(self::BRANCH_ID, $assignment->getBranch()->getId());
		$this->assertSame(self::BRANCH_NAME, $assignment->getBranch()->getName());
	}
	
	
	
	private function getMenuEntryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getMenuEntry());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MENU_ENTRY_ID);
	
		return $mock;
	}
	
	private function getBranchTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getBranch());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MENU_ENTRY_ID);
	
		return $mock;
	}
	
	
	private function getMenuEntry() {
		$mock = new MenuEntry();
		$mock->setId(self::MENU_ENTRY_ID);
		$mock->setName(self::MENU_ENTRY_NAME);
		
		return $mock;
	}
	
	private function getBranch() {
		$mock = new Branch();
		$mock->setId(self::BRANCH_ID);
		$mock->setName(self::BRANCH_NAME);
	
		return $mock;
	}
}