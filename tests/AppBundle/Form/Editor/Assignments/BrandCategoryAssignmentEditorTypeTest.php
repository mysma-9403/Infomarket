<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\BrandCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class BrandCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const BRAND_ID = 100;
	const BRAND_NAME = 'Test brand';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'brand' => self::BRAND_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_BRAND_LIST = ['Test brand' => self::BRAND_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'brand' => self::FORM_BRAND_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $brandTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->brandTransformer = $this->getBrandTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new BrandCategoryAssignmentEditorType($this->brandTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(BrandCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new BrandCategoryAssignment();
		$form = $this->factory->create(BrandCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::BRAND_ID, $assignment->getBrand()->getId());
		$this->assertSame(self::BRAND_NAME, $assignment->getBrand()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getBrandTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getBrand());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::BRAND_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::BRAND_ID);
	
		return $mock;
	}
	
	
	private function getBrand() {
		$mock = new Brand();
		$mock->setId(self::BRAND_ID);
		$mock->setName(self::BRAND_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}