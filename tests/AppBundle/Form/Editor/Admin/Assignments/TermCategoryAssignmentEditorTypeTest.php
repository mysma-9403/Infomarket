<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Assignments\Term;
use AppBundle\Entity\Assignments\TermCategoryAssignment;
use AppBundle\Entity\Assignments\Category;
use AppBundle\Form\Editor\Admin\Assignments\TermCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEditorTypeTest;

class TermCategoryAssignmentEditorTypeTest extends BaseEditorTypeTest {
		
	const TERM_ID = 100;
	const TERM_NAME = 'Test term';
	const TERM_CHOICES = ['Test term' => self::TERM_ID];
	
	const CATEGORY_ID = 100;
	const CATEGORY_NAME = 'Test category';
	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];
	
	
	
	private $termTransformer;
	
	private $categoryTransformer;
	
	
	
	protected function setUp() {
		$this->termTransformer = $this->getEntityTransformerMock($this->getTerm(), self::TERM_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}
	
	protected function getExtensions() {
		$type = new TermCategoryAssignmentEditorType($this->termTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}
	
	
	
	protected function assertEntity($entity) {
		/** @var TermCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::TERM_ID, $entity->getTerm()->getId());
		$this->assertSame(self::TERM_NAME, $entity->getTerm()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
	}
	
	protected function getFormData() {
		$data = parent::getFormData();
	
		$data['term'] = self::TERM_ID;
		$data['category'] = self::CATEGORY_ID;
		
		return $data;
	}
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		$options[self::getChoicesName('term')] = self::TERM_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
	
		return $options;
	}
	
	protected function getFormType() {
		return TermCategoryAssignmentEditorType::class;
	}
	
	protected function getEntity() {
		return new TermCategoryAssignment();
	}
	
	
	
	private function getTerm() {
		$mock = new Term();
		$mock->setId(self::TERM_ID);
		$mock->setName(self::TERM_NAME);
		
		return $mock;
	}
	
	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
	
		return $mock;
	}
}