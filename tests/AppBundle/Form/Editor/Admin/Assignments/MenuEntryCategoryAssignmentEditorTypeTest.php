<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\MenuEntry;
use AppBundle\Entity\Assignments\MenuEntryCategoryAssignment;
use AppBundle\Form\Editor\Admin\Assignments\MenuEntryCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class MenuEntryCategoryAssignmentEditorTypeTest extends SimpleEditorTypeTest {

	const MENU_ENTRY_ID = 100;

	const MENU_ENTRY_NAME = 'Test menuEntry';

	const MENU_ENTRY_CHOICES = ['Test menuEntry' => self::MENU_ENTRY_ID];

	const CATEGORY_ID = 100;

	const CATEGORY_NAME = 'Test category';

	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];

	private $menuEntryTransformer;

	private $categoryTransformer;

	protected function setUp() {
		$this->menuEntryTransformer = $this->getEntityTransformerMock($this->getMenuEntry(), 
				self::MENU_ENTRY_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new MenuEntryCategoryAssignmentEditorType($this->menuEntryTransformer, 
				$this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		/** @var MenuEntryCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::MENU_ENTRY_ID, $entity->getMenuEntry()->getId());
		$this->assertSame(self::MENU_ENTRY_NAME, $entity->getMenuEntry()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['menuEntry'] = self::MENU_ENTRY_ID;
		$data['category'] = self::CATEGORY_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('menuEntry')] = self::MENU_ENTRY_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return MenuEntryCategoryAssignmentEditorType::class;
	}

	protected function getEntity() {
		return new MenuEntryCategoryAssignment();
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