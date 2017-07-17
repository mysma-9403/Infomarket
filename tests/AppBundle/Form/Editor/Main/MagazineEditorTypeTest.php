<?php

namespace Tests\AppBundle\Form\Editor\Main;

use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Main\MagazineEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Base\ImageEntityEditorTypeTest;

class MagazineEditorTypeTest extends ImageEntityEditorTypeTest {
	
	const ORDER_NUMBER = 76;
	const MAGAZINE_FILE = 'c:/test/file.pdf';
	const MAIN = true;
	const FEATURED = true;
	const CONTENT = 'Test content';
	const DATE = '10/2017';
	
	const PARENT_ID = 1071;
	const PARENT_NAME = 'Test name';
	const PARENT_CHOICES = ['Parent' => self::PARENT_ID];
	
	
	
	private $parentTransformer;
	
	
	
	protected function setUp() {
		$this->parentTransformer = $this->getEntityTransformerMock($this->getParent(), self::PARENT_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new MagazineEditorType($this->parentTransformer);
		
		return array(new PreloadedExtension(array($this->getCKEditor(), $type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var Magazine $entity */
		$this->assertSame(self::ORDER_NUMBER, $entity->getOrderNumber());
		$this->assertSame(self::MAGAZINE_FILE, $entity->getMagazineFile());
		$this->assertSame(self::MAIN, $entity->getMain());
		$this->assertSame(self::FEATURED, $entity->getFeatured());
		$this->assertSame(self::CONTENT, $entity->getContent());
		$this->assertDate(self::DATE, $entity->getDate());
		
		$this->assertSame(self::PARENT_ID, $entity->getParent()->getId());
		$this->assertSame(self::PARENT_NAME, $entity->getParent()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['orderNumber'] = self::ORDER_NUMBER;
		$data['magazineFile'] = self::MAGAZINE_FILE;
		$data['main'] = self::MAIN;
		$data['featured'] = self::FEATURED;
		$data['content'] = self::CONTENT;
		$data['date'] = self::DATE;
		$data['parent'] = self::PARENT_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('parent')] = self::PARENT_CHOICES;
		
		return $options;
	}
	
	protected function getFormType() {
		return MagazineEditorType::class;
	}
	
	protected function getEntity() {
		return new Magazine();
	}
	
	
	
	private function getParent() {
		$mock = new Magazine();
		$mock->setId(self::PARENT_ID);
		$mock->setName(self::PARENT_NAME);
	
		return $mock;
	}
}