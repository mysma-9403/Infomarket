<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\MagazineCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class MagazineCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const MAGAZINE_ID = 100;
	const MAGAZINE_NAME = 'Test magazine';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'magazine' => self::MAGAZINE_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_MAGAZINE_LIST = ['Test magazine' => self::MAGAZINE_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'magazine' => self::FORM_MAGAZINE_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $magazineTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->magazineTransformer = $this->getMagazineTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MagazineCategoryAssignmentEditorType($this->magazineTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(MagazineCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new MagazineCategoryAssignment();
		$form = $this->factory->create(MagazineCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::MAGAZINE_ID, $assignment->getMagazine()->getId());
		$this->assertSame(self::MAGAZINE_NAME, $assignment->getMagazine()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getMagazineTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getMagazine());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MAGAZINE_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::MAGAZINE_ID);
	
		return $mock;
	}
	
	
	private function getMagazine() {
		$mock = new Magazine();
		$mock->setId(self::MAGAZINE_ID);
		$mock->setName(self::MAGAZINE_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}