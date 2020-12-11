<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\Category;
use AppBundle\Form\Editor\Admin\Main\CategoryEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\ImageEditorTypeTest;

class CategoryEditorTypeTest extends ImageEditorTypeTest {

	const NAME = 'Test name';

	const SUBNAME = 'Test subname';

	const INFOMARKET = true;

	const INFOPRODUKT = true;

	const FEATURED = true;

	const PRELEAF = true;

	const BENCHMARK = true;

	const ORDER_NUMBER = 76;

	const ICON = 'fa fa-test';

	const ICON_IMAGE = 'c:/test/icon.png';

	const FEATURED_IMAGE = 'c:/test/featured.jpg';

	const CONTENT = 'Test content';

	const PARENT_ID = 1071;

	const PARENT_NAME = 'Test name';

	const PARENT_CHOICES = ['Parent' => self::PARENT_ID];

	private $parentTransformer;

	protected function setUp() {
		$this->parentTransformer = $this->getEntityTransformerMock($this->getParent(), self::PARENT_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new CategoryEditorType($this->parentTransformer);
		
		return array(new PreloadedExtension(array($this->getCKEditor(), $type), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var Category $entity */
		$this->assertSame(self::NAME, $entity->getName());
		$this->assertSame(self::SUBNAME, $entity->getSubname());
		
		$this->assertSame(self::INFOMARKET, $entity->getInfomarket());
		$this->assertSame(self::INFOPRODUKT, $entity->getInfoprodukt());
		$this->assertSame(self::FEATURED, $entity->getFeatured());
		$this->assertSame(self::PRELEAF, $entity->getPreleaf());
		$this->assertSame(self::BENCHMARK, $entity->getBenchmark());
		
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		
		$this->assertSame(self::ICON, $entity->getIcon());
		$this->assertSame(self::ICON_IMAGE, $entity->getIconImage());
		$this->assertSame(self::FEATURED_IMAGE, $entity->getFeaturedImage());
		
		$this->assertSame(self::CONTENT, $entity->getContent());
		
		$this->assertSame(self::PARENT_ID, $entity->getParent()->getId());
		$this->assertSame(self::PARENT_NAME, $entity->getParent()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['name'] = self::NAME;
		$data['subname'] = self::SUBNAME;
		
		$data['infomarket'] = self::INFOMARKET;
		$data['infoprodukt'] = self::INFOPRODUKT;
		$data['featured'] = self::FEATURED;
		$data['preleaf'] = self::PRELEAF;
		$data['benchmark'] = self::BENCHMARK;
		
		$data['orderNumber'] = self::ORDER_NUMBER;
		
		$data['icon'] = self::ICON;
		$data['iconImage'] = self::ICON_IMAGE;
		$data['featuredImage'] = self::FEATURED_IMAGE;
		
		$data['content'] = self::CONTENT;
		$data['parent'] = self::PARENT_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('parent')] = self::PARENT_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return CategoryEditorType::class;
	}

	protected function getEntity() {
		return new Category();
	}

	private function getParent() {
		$mock = new Category();
		$mock->setId(self::PARENT_ID);
		$mock->setName(self::PARENT_NAME);
		
		return $mock;
	}
}