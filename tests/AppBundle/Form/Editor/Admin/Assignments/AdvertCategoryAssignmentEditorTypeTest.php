<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\Advert;
use AppBundle\Entity\Assignments\AdvertCategoryAssignment;
use AppBundle\Entity\Assignments\Category;
use AppBundle\Form\Editor\Admin\Assignments\AdvertCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEditorTypeTest;

class AdvertCategoryAssignmentEditorTypeTest extends BaseEditorTypeTest {
		
	const ADVERT_ID = 100;
	const ADVERT_NAME = 'Test advert';
	const ADVERT_CHOICES = ['Test advert' => self::ADVERT_ID];
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];
	
	
	
	private $advertTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->advertTransformer = $this->getEntityTransformerMock($this->getAdvert(), self::ADVERT_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new AdvertCategoryAssignmentEditorType($this->advertTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var AdvertCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::ADVERT_ID, $entity->getAdvert()->getId());
		$this->assertSame(self::ADVERT_NAME, $entity->getAdvert()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['advert'] = self::ADVERT_ID;
		$data['category'] = self::CATEGORY_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('advert')] = self::ADVERT_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return AdvertCategoryAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new AdvertCategoryAssignment();
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