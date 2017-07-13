<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Branch;
use AppBundle\Entity\BranchCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\BranchCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class BranchCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const BRANCH_ID = 100;
	const BRANCH_NAME = 'Test branch';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'branch' => self::BRANCH_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_BRANCH_LIST = ['Test branch' => self::BRANCH_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'branch' => self::FORM_BRANCH_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $branchTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->branchTransformer = $this->getBranchTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new BranchCategoryAssignmentEditorType($this->branchTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(BranchCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new BranchCategoryAssignment();
		$form = $this->factory->create(BranchCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::BRANCH_ID, $assignment->getBranch()->getId());
		$this->assertSame(self::BRANCH_NAME, $assignment->getBranch()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getBranchTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getBranch());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::BRANCH_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::BRANCH_ID);
	
		return $mock;
	}
	
	
	private function getBranch() {
		$mock = new Branch();
		$mock->setId(self::BRANCH_ID);
		$mock->setName(self::BRANCH_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}