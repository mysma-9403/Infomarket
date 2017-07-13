<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\User;
use AppBundle\Entity\UserCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\UserCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class UserCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const USER_ID = 100;
	const USER_NAME = 'Test user';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'user' => self::USER_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_USER_LIST = ['Test user' => self::USER_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'user' => self::FORM_USER_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $userTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->userTransformer = $this->getUserTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new UserCategoryAssignmentEditorType($this->userTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(UserCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new UserCategoryAssignment();
		$form = $this->factory->create(UserCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::USER_ID, $assignment->getUser()->getId());
		$this->assertSame(self::USER_NAME, $assignment->getUser()->getUsername());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getUserTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getUser());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::USER_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::USER_ID);
	
		return $mock;
	}
	
	
	private function getUser() {
		$mock = new User();
		$mock->setId(self::USER_ID);
		$mock->setUsername(self::USER_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}