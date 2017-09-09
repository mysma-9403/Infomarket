<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Product;
use AppBundle\Form\Editor\Admin\Main\ProductEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;
use AppBundle\Entity\Main\Brand;
use AppBundle\Form\FormBuilder\BenchmarkEditorFieldBuilder;
use AppBundle\Filter\Common\Other\ProductFilter;

class ProductEditorTypeTest extends ImageEditorTypeTest {

	const NAME = 'Test name';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const TOP_PRODUCT_IMAGE = 'web/img/product/top/test.png';

	const PRICE = 1499.99;

	const BRAND_ID = 134;

	const BRAND_NAME = 'Test name';

	const BRAND_CHOICES = ['brand' => self::BRAND_ID];

	const FILTER_FIELDS = [['field1'], ['field2'], ['field3']];

	private $brandTransformer;

	private $benchmarkFieldEditorBuilder;

	protected function setUp() {
		$this->brandTransformer = $this->getEntityTransformerMock($this->getBrand(), self::BRAND_ID);
		$this->benchmarkFieldEditorBuilder = $this->getBenchmarkEditorFieldBuilderMock(
				count(self::FILTER_FIELDS));
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new ProductEditorType($this->brandTransformer, $this->benchmarkFieldEditorBuilder);
		
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Product $entity */
		$this->assertSame(self::NAME, $entity->getName());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		
		$this->assertSame(self::TOP_PRODUCT_IMAGE, $entity->getTopProduktImage());
		$this->assertSame(self::PRICE, $entity->getPrice());
		
		$this->assertSame(self::BRAND_ID, $entity->getBrand()->getId());
		$this->assertSame(self::BRAND_NAME, $entity->getBrand()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		
		$data['topProduktImage'] = self::TOP_PRODUCT_IMAGE;
		$data['price'] = self::PRICE;
		
		$data['brand'] = self::BRAND_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('brand')] = self::BRAND_CHOICES;
		$options['filter'] = $this->getProductFilterMock();
		
		return $options;
	}

	protected function getFormType() {
		return ProductEditorType::class;
	}

	protected function getEntity() {
		return new Product();
	}

	private function getBrand() {
		$mock = new Brand();
		$mock->setId(self::BRAND_ID);
		$mock->setName(self::BRAND_NAME);
		
		return $mock;
	}

	private function getBenchmarkEditorFieldBuilderMock($count) {
		$mock = $this->getMockBuilder(BenchmarkEditorFieldBuilder::class)->disableOriginalConstructor()->getMock();
		
		$mock->expects($this->atMost($count))->method('add');
		
		return $mock;
	}

	private function getProductFilterMock() {
		$mock = $this->getMockBuilder(ProductFilter::class)->disableOriginalConstructor()->getMock();
		
		$mock->expects($this->atMost(1))->method('getEditorFields')->willReturn(self::FILTER_FIELDS);
		
		return $mock;
	}
}