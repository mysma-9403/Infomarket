<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\ProductCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use AppBundle\Entity\Segment;

class ProductCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const PRODUCT_ID = 100;
	const PRODUCT_NAME = 'Test product';
	
	const SEGMENT_ID = 100;
	const SEGMENT_NAME = 'Test segment';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const ORDER_NUMBER = 13;
	const FEATURED = true;
	
	const FORM_DATA = [
			'product' => self::PRODUCT_ID,
			'segment' => self::SEGMENT_ID,
			'category' => self::CATEGORY_ID,
			'orderNumber' => self::ORDER_NUMBER,
			'featured' => self::FEATURED
	];
	
	const FORM_PRODUCT_LIST = ['Test product' => self::PRODUCT_ID];
	const FORM_SEGMENT_LIST = ['Test product' => self::PRODUCT_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'product' => self::FORM_PRODUCT_LIST,
			'segment' => self::FORM_SEGMENT_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $productTransformer;
	
	private $segmentTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->productTransformer = $this->getProductTransformerMock();
		$this->segmentTransformer = $this->getSegmentTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new ProductCategoryAssignmentEditorType($this->productTransformer, $this->segmentTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(ProductCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
		
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new ProductCategoryAssignment();
		$form = $this->factory->create(ProductCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::PRODUCT_ID, $assignment->getProduct()->getId());
		$this->assertSame(self::PRODUCT_NAME, $assignment->getProduct()->getName());
		$this->assertSame(self::SEGMENT_ID, $assignment->getSegment()->getId());
		$this->assertSame(self::SEGMENT_NAME, $assignment->getSegment()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
		$this->assertSame(self::ORDER_NUMBER, $assignment->getOrderNumber());
		$this->assertSame(self::FEATURED, $assignment->getFeatured());
	}
	
	
	
	private function getProductTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getProduct());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::PRODUCT_ID);
	
		return $mock;
	}
	
	private function getSegmentTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getSegment());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::PRODUCT_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::PRODUCT_ID);
	
		return $mock;
	}
	
	
	private function getProduct() {
		$mock = new Product();
		$mock->setId(self::PRODUCT_ID);
		$mock->setName(self::PRODUCT_NAME);
		
		return $mock;
	}
	
	private function getSegment() {
		$mock = new Segment();
		$mock->setId(self::SEGMENT_ID);
		$mock->setName(self::SEGMENT_NAME);
	
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}