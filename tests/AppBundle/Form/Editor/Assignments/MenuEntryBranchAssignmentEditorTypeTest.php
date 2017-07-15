<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Branch;
use AppBundle\Entity\MenuEntry;
use AppBundle\Entity\MenuEntryBranchAssignment;
use AppBundle\Form\Editor\Assignments\MenuEntryBranchAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Base\BaseEntityEditorTypeTest;

class MenuEntryBranchAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const MENU_ENTRY_ID = 100;
	const MENU_ENTRY_NAME = 'Test menuEntry';
	const MENU_ENTRY_CHOICES = ['Test menuEntry' => self::MENU_ENTRY_ID];
	
	const BRANCH_ID = 100;
	const BRANCH_NAME = 'Test branch';
	const BRANCH_CHOICES = ['Test branch' => self::BRANCH_ID];
	
	
	
	private $menuEntryTransformer;
	
	private $branchTransformer;
	
	
	
	protected function setUp() {
		$this->menuEntryTransformer = $this->getEntityTransformerMock($this->getMenuEntry(), self::MENU_ENTRY_ID);
		$this->branchTransformer = $this->getEntityTransformerMock($this->getBranch(), self::BRANCH_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MenuEntryBranchAssignmentEditorType($this->menuEntryTransformer, $this->branchTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var MenuEntryBranchAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::MENU_ENTRY_ID, $entity->getMenuEntry()->getId());
		$this->assertSame(self::MENU_ENTRY_NAME, $entity->getMenuEntry()->getName());
		
		$this->assertSame(self::BRANCH_ID, $entity->getBranch()->getId());
		$this->assertSame(self::BRANCH_NAME, $entity->getBranch()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['menuEntry'] = self::MENU_ENTRY_ID;
		$data['branch'] = self::BRANCH_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('menuEntry')] = self::MENU_ENTRY_CHOICES;
		$options[self::getChoicesName('branch')] = self::BRANCH_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return MenuEntryBranchAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new MenuEntryBranchAssignment();
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