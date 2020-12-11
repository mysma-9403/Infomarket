<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Main\Branch;
use AppBundle\Entity\Assignments\BranchCategoryAssignment;
use AppBundle\Entity\Main\Category;
use AppBundle\Form\Editor\Admin\Assignments\BranchCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class BranchCategoryAssignmentEditorTypeTest extends SimpleEditorTypeTest {

	const BRANCH_ID = 100;

	const BRANCH_NAME = 'Test branch';

	const BRANCH_CHOICES = ['Test branch' => self::BRANCH_ID];

	const CATEGORY_ID = 100;

	const CATEGORY_NAME = 'Test category';

	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];

	private $branchTransformer;

	private $categoryTransformer;

	protected function setUp() {
		$this->branchTransformer = $this->getEntityTransformerMock($this->getBranch(), self::BRANCH_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new BranchCategoryAssignmentEditorType($this->branchTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		/** @var BranchCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::BRANCH_ID, $entity->getBranch()->getId());
		$this->assertSame(self::BRANCH_NAME, $entity->getBranch()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['branch'] = self::BRANCH_ID;
		$data['category'] = self::CATEGORY_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('branch')] = self::BRANCH_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return BranchCategoryAssignmentEditorType::class;
	}

	protected function getEntity() {
		return new BranchCategoryAssignment();
	}

	private function getBranch() {
		$mock = new Branch();
		$mock->setId(self::BRANCH_ID);
		$mock->setName(self::BRANCH_NAME);
		
		return $mock;
	}

	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
		
		return $mock;
	}
}