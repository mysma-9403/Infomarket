<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Term;
use AppBundle\Entity\TermCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\TermCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class TermCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const TERM_ID = 100;
	const TERM_NAME = 'Test term';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'term' => self::TERM_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_TERM_LIST = ['Test term' => self::TERM_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'term' => self::FORM_TERM_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $termTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->termTransformer = $this->getTermTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new TermCategoryAssignmentEditorType($this->termTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(TermCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new TermCategoryAssignment();
		$form = $this->factory->create(TermCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::TERM_ID, $assignment->getTerm()->getId());
		$this->assertSame(self::TERM_NAME, $assignment->getTerm()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getTermTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getTerm());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::TERM_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::TERM_ID);
	
		return $mock;
	}
	
	
	private function getTerm() {
		$mock = new Term();
		$mock->setId(self::TERM_ID);
		$mock->setName(self::TERM_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}