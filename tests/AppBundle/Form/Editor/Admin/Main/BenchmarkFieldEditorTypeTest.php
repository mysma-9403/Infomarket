<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use AppBundle\Form\Editor\Admin\Main\BenchmarkFieldEditorType;
use Symfony\Component\Form\PreloadedExtension;
use Tests\AppBundle\Form\Editor\Admin\Base\SimpleEditorTypeTest;

class BenchmarkFieldEditorTypeTest extends SimpleEditorTypeTest {

	const VALUE_NUMBER = 5;

	const FIELD_NUMBER = 7;

	const FILTER_NUMBER = 2;

	const FIELD_NAME = 'Field name';

	const FILTER_NAME = 'Filter name';

	const SHOW_FIELD = true;

	const SHOW_FILTER = true;

	const FEATURED_FIELD = true;

	const FEATURED_FILTER = true;

	const DECIMAL_PLACES = 2;

	const NOTE_WEIGHT = 2.5;

	const COMPARE_WEIGHT = 1.25;

	const CATEGORY_ID = 1071;

	const CATEGORY_NAME = 'Test name';

	const CATEGORY_CHOICES = ['Test category' => self::CATEGORY_ID];

	const FIELD_TYPE = 2;

	const FIELD_TYPE_CHOICES = ['Field type' => self::FIELD_TYPE];

	const NOTE_TYPE = 2;

	const NOTE_TYPE_CHOICES = ['Note type' => self::NOTE_TYPE];

	const BETTER_THAN_TYPE = 2;

	const BETTER_THAN_CHOICES = ['Better than type' => self::BETTER_THAN_TYPE];

	private $categoryTransformer;

	protected function setUp() {
		$this->categoryTransformer = $this->getEntityTransformerMock($this->getCategory(), self::CATEGORY_ID);
		
		parent::setUp();
	}

	protected function getExtensions() {
		$type = new BenchmarkFieldEditorType($this->categoryTransformer);
		
		return array(new PreloadedExtension(array($type), array()));
	}

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var BenchmarkField $entity */
		$this->assertSame(self::VALUE_NUMBER, $entity->getValueNumber());
		$this->assertSame(self::FIELD_NUMBER, $entity->getFieldNumber());
		$this->assertSame(self::FILTER_NUMBER, $entity->getFilterNumber());
		
		$this->assertSame(self::FIELD_NAME, $entity->getFieldName());
		$this->assertSame(self::FILTER_NAME, $entity->getFilterName());
		
		$this->assertSame(self::SHOW_FIELD, $entity->getShowField());
		$this->assertSame(self::SHOW_FILTER, $entity->getShowFilter());
		
		$this->assertSame(self::FEATURED_FIELD, $entity->getFeaturedField());
		$this->assertSame(self::FEATURED_FILTER, $entity->getFeaturedFilter());
		
		$this->assertSame(self::DECIMAL_PLACES, $entity->getDecimalPlaces());
		
		$this->assertSame(self::NOTE_WEIGHT, $entity->getNoteWeight());
		$this->assertSame(self::COMPARE_WEIGHT, $entity->getCompareWeight());
		
		$this->assertSame(self::CATEGORY_ID, $entity->getCategory()->getId());
		$this->assertSame(self::CATEGORY_NAME, $entity->getCategory()->getName());
		
		$this->assertSame(self::FIELD_TYPE, $entity->getFieldType());
		$this->assertSame(self::NOTE_TYPE, $entity->getNoteType());
		$this->assertSame(self::BETTER_THAN_TYPE, $entity->getBetterThanType());
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['valueNumber'] = self::VALUE_NUMBER;
		$data['fieldNumber'] = self::FIELD_NUMBER;
		$data['filterNumber'] = self::FILTER_NUMBER;
		
		$data['fieldName'] = self::FIELD_NAME;
		$data['filterName'] = self::FILTER_NAME;
		
		$data['showField'] = self::SHOW_FIELD;
		$data['showFilter'] = self::SHOW_FILTER;
		
		$data['featuredField'] = self::FEATURED_FIELD;
		$data['featuredFilter'] = self::FEATURED_FILTER;
		
		$data['decimalPlaces'] = self::DECIMAL_PLACES;
		
		$data['noteWeight'] = self::NOTE_WEIGHT;
		$data['compareWeight'] = self::COMPARE_WEIGHT;
		
		$data['category'] = self::CATEGORY_ID;
		
		$data['fieldType'] = self::FIELD_TYPE;
		$data['noteType'] = self::NOTE_TYPE;
		$data['betterThanType'] = self::BETTER_THAN_TYPE;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('category')] = self::CATEGORY_CHOICES;
		
		$options[self::getChoicesName('fieldType')] = self::FIELD_TYPE_CHOICES;
		$options[self::getChoicesName('noteType')] = self::NOTE_TYPE_CHOICES;
		$options[self::getChoicesName('betterThanType')] = self::BETTER_THAN_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return BenchmarkFieldEditorType::class;
	}

	protected function getEntity() {
		return new BenchmarkField();
	}

	private function getCategory() {
		$mock = new Category();
		$mock->setId(self::CATEGORY_ID);
		$mock->setName(self::CATEGORY_NAME);
		
		return $mock;
	}
}