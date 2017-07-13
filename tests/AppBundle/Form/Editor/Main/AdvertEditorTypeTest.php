<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Entity\Segment;
use AppBundle\Form\Editor\Main\AdvertEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\Test\TypeTestCase;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use Tests\AppBundle\Form\Editor\Base\BaseEntityEditorTypeTest;

class AdvertEditorTypeTest extends TypeTestCase {
	
	const LOCATION = 13;
	const DATE_FROM = '19/10/1987 12:00';
	const DATE_TO = '21/11/2027 13:45';
	const LINK = 'www.krk-dev.com';
	const SHOW_LIMIT = 3000;
	const CLICK_LIMIT = 200;
	
	const FORM_DATA = [
			'location' => self::LOCATION,
			'dateFrom' => self::DATE_FROM,
			'dateTo' => self::DATE_TO,
			'link' => self::LINK,
			'showLimit' => self::SHOW_LIMIT,
			'clickLimit' => self::CLICK_LIMIT
	];
	
	const LOCATION_CHOICES = ['Test location' => self::LOCATION];
	
	const FORM_OPTIONS = [
			'locations' => self::LOCATION_CHOICES
	];
	
	
	
	public function testViewProperties()
	{
		$form = $this->factory->create(AdvertEditorType::class);
	
		$view = $form->createView();
		
		foreach (array_keys(self::FORM_DATA) as $key)
			$this->assertArrayHasKey($key, $view->children);
		
		$count = 10;//count(self::FORM_DATA) + count(BaseEntityEditorTypeTest::FORM_DATA) + 1;
		$this->assertCount($count, $view->children);
	}
	
	public function testSubmitValidData()
	{	
		$entity = new Advert();
		$form = $this->factory->create(AdvertEditorType::class, $entity, self::FORM_OPTIONS);
		
		$form->submit(self::FORM_DATA);
		
		$this->assertTrue($form->isSynchronized());
		$this->assertSame($entity, $form->getData());
		$this->assertSame(self::LOCATION, $entity->getLocation());
		$this->assertSame(self::DATE_FROM, $entity->getDateFrom()->format('d/m/Y H:i'));
		$this->assertSame(self::DATE_TO, $entity->getDateTo()->format('d/m/Y H:i'));
		$this->assertSame(self::LINK, $entity->getLink());
		$this->assertSame(self::SHOW_LIMIT, $entity->getShowLimit());
		$this->assertSame(self::CLICK_LIMIT, $entity->getClickLimit());
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