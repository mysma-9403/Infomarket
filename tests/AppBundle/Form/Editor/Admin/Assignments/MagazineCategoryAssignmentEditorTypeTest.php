<?php

namespace Tests\AppBundle\Form\Editor\Admin\Assignments;

use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Magazine;
use AppBundle\Entity\Assignments\MagazineCategoryAssignment;
use AppBundle\Form\Editor\Admin\Assignments\MagazineCategoryAssignmentEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class MagazineCategoryAssignmentEditorTypeTest extends SimpleEditorTypeTest {

	const MAGAZINE_ID = 100;

	const MAGAZINE_NAME = 'Test magazine';

	const MAGAZINE_CHOICES = ['Test magazine' => self::MAGAZINE_ID];

	const CATEGORY_ID = 100;

	const CATEGORY_NAME = 'Test category';

	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];

	private $magazineTransformer;

	private $categoryTransformer;

	protected function setUp() {
		$this->magazineTransformer = $this->getEntityTransformerMock($this->getMagazine(), self::MAGAZINE_ID);
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new MagazineCategoryAssignmentEditorType($this->magazineTransformer, $this->categoryTransformer);
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		/** @var MagazineCategoryAssignment $entity */
		parent::assertEntity($entity);
		
		$this->assertSame(self::MAGAZINE_ID, $entity->getMagazine()->getId());
		$this->assertSame(self::MAGAZINE_NAME, $entity->getMagazine()->getName());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['magazine'] = self::MAGAZINE_ID;
		$data['category'] = self::CATEGORY_ID;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('magazine')] = self::MAGAZINE_CHOICES;
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return MagazineCategoryAssignmentEditorType::class;
	}

	protected function getEntity() {
		return new MagazineCategoryAssignment();
	}

	private function getMagazine() {
		$mock = new Magazine();
		$mock->setId(self::MAGAZINE_ID);
		$mock->setName(self::MAGAZINE_NAME);
		
		return $mock;
	}

	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
		
		return $mock;
	}
}