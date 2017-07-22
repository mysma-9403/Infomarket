<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Admin\Assignments\BrandCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEntityEditorTypeTest;

class BrandCategoryAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const BRAND_ID = 100;
	const BRAND_NAME = 'Test brand';
	const BRAND_CHOICES = ['Test brand' => self::BRAND_ID];
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];
	
	const ORDER_NUMBER = 3;
	
	
	
	private $brandTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->brandTransformer = $this->getEntityTransformerMock($this->getBrand(), self::BRAND_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new BrandCategoryAssignmentEditorType($this->brandTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var BrandCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::BRAND_ID, $entity->getBrand()->getId());
		$this->assertSame(self::BRAND_NAME, $entity->getBrand()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
		
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['brand'] = self::BRAND_ID;
		$data['category'] = self::CATEGORY_ID;
		
		$data['orderNumber'] = self::ORDER_NUMBER;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('brand')] = self::BRAND_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return BrandCategoryAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new BrandCategoryAssignment();
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