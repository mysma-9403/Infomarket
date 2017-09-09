<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Product;
use AppBundle\Entity\Assignments\ProductCategoryAssignment;
use AppBundle\Form\Editor\Admin\Assignments\ProductCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;
use AppBundle\Entity\Main\Segment;

class ProductCategoryAssignmentEditorTypeTest extends SimpleEditorTypeTest {

	const PRODUCT_ID = 100;

	const PRODUCT_NAME = 'Test product';

	const PRODUCT_CHOICES = ['Test product' => self::PRODUCT_ID];

	const SEGMENT_ID = 100;

	const SEGMENT_NAME = 'Test segment';

	const SEGMENT_CHOICES = ['Test segment' => self::SEGMENT_ID];

	const CATEGORY_ID = 100;

	const CATEGORY_NAME = 'Test category';

	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];

	const ORDER_NUMBER = 11;

	const FEATURED = true;

	private $productTransformer;

	private $segmentTransformer;

	private $categoryTransformer;

	protected function setUp() {
		$this->productTransformer = $this->getEntityTransformerMock($this->getProduct(), self::PRODUCT_ID);
		$this->segmentTransformer = $this->getEntityTransformerMock($this->getSegment(), self::SEGMENT_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new ProductCategoryAssignmentEditorType($this->productTransformer, $this->segmentTransformer, 
				$this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		/** @var ProductCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::PRODUCT_ID, $entity->getProduct()->getId());
		$this->assertSame(self::PRODUCT_NAME, $entity->getProduct()->getName());
		
		$this->assertSame(self::SEGMENT_ID, $entity->getSegment()->getId());
		$this->assertSame(self::SEGMENT_NAME, $entity->getSegment()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
		
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		$this->assertSame(self::FEATURED, $entity->getFeatured());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['product'] = self::PRODUCT_ID;
		$data['segment'] = self::SEGMENT_ID;
		$data['category'] = self::CATEGORY_ID;
		
		$data['orderNumber'] = self::ORDER_NUMBER;
		$data['featured'] = self::FEATURED;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('product')] = self::PRODUCT_CHOICES;
		$options[self::getChoicesName('segment')] = self::SEGMENT_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return ProductCategoryAssignmentEditorType::class;
	}

	protected function getEntity() {
		return new ProductCategoryAssignment();
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