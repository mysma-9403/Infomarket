<?php

namespace Tests\AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Category;
use AppBundle\Entity\User;
use AppBundle\Form\Editor\Assignments\UserCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Base\BaseEntityEditorTypeTest;
use AppBundle\Entity\UserCategoryAssignment;

class UserCategoryAssignmentEditorTypeTest extends BaseEntityEditorTypeTest {
		
	const USER_ID = 100;
	const USER_NAME = 'Test user';
	const USER_CHOICES = ['Test user' => self::USER_ID];
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];
	
	
	
	private $userTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->userTransformer = $this->getEntityTransformerMock($this->getUser(), self::USER_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new UserCategoryAssignmentEditorType($this->userTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var UserCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::USER_ID, $entity->getUser()->getId());
		$this->assertSame(self::USER_NAME, $entity->getUser()->getUsername());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['user'] = self::USER_ID;
		$data['category'] = self::CATEGORY_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('user')] = self::USER_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return UserCategoryAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new UserCategoryAssignment();
	}
	
	
	
	private function getUser() {
		$mock = new User();
		$mock->setId(self::USER_ID);
		$mock->setUsername(self::USER_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}