<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Advert;
use AppBundle\Entity\AdvertCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Assignments\AdvertCategoryAssignmentEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class AdvertCategoryAssignmentEditorTypeTest extends TypeTestCase {
		
	const ADVERT_ID = 100;
	const ADVERT_NAME = 'Test advert';
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	
	const FORM_DATA = [
			'advert' => self::ADVERT_ID,
			'category' => self::CATEGORY_ID
	];
	
	const FORM_ADVERT_LIST = ['Test advert' => self::ADVERT_ID];
	const FORM_CATEGORY_LIST = ['Test category' => self::CATEGORY_ID];
	
	const FORM_OPTIONS = [
			'advert' => self::FORM_ADVERT_LIST,
			'category' => self::FORM_CATEGORY_LIST
	];
	
	
	
	private $advertTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->advertTransformer = $this->getAdvertTransformerMock();
		$this->categoryTransformer = $this->getCategoryTransformerMock();
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new AdvertCategoryAssignmentEditorType($this->advertTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(AdvertCategoryAssignmentEditorType::class);
	
		$view = $form->createView();
	
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$this->assertCount(count(self::FORM_DATA)+1, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$assignment = new AdvertCategoryAssignment();
		$form = $this->factory->create(AdvertCategoryAssignmentEditorType::class, $assignment, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($assignment, $form->getData());
		$this->assertSame(self::ADVERT_ID, $assignment->getAdvert()->getId());
		$this->assertSame(self::ADVERT_NAME, $assignment->getAdvert()->getName());
		$this->assertSame(self::CATEGORY_ID, $assignment->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $assignment->getCategory()->getName());
	}
	
	
	
	private function getAdvertTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getAdvert());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ADVERT_ID);
	
		return $mock;
	}
	
	private function getCategoryTransformerMock() {
		$mock = $this->getMockBuilder ( EntityToNumberTransformer::class )->disableOriginalConstructor ()->getMock ();
	
		$mock->expects ($this->any())->method ( 'reverseTransform' )->willReturn($this->getCategory());
		$mock->expects ($this->any())->method ( 'transform' )->willReturn(self::ADVERT_ID);
	
		return $mock;
	}
	
	
	private function getAdvert() {
		$mock = new Advert();
		$mock->setId(self::ADVERT_ID);
		$mock->setName(self::ADVERT_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}