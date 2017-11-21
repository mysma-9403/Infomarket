<?php

namespace AppBundle\Logic\Common\BenchmarkField\Provider;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

class BenchmarkFieldsProvider {

	const PRICE_FIELD = 'price';

	const PRICE_LABEL = 'label.price';

	const PRICE_DECIMAL_PLACES = 2;

	/**
	 *
	 * @var TranslatorInterface
	 */
	protected $translator;

	public function __construct(TranslatorInterface $translator) {
		$this->translator = $translator;
	}

	public function getAllFields(Category $item) {
		return $item->getBenchmarkFields();
	}

	public function getShowFields(Category $item) {
		$result = [];
		
		/** @var BenchmarkField $field */
		foreach ($item->getBenchmarkFields() as $field) {
			if ($field->getShowField()) {
				$result[] = $field;
			}
		}
		
		return $result;
	}

	public function getFilterFields(Category $item) {
		$result = [];
		
		/** @var BenchmarkField $field */
		foreach ($item->getBenchmarkFields() as $field) {
			if ($field->getShowFilter()) {
				$result[] = $field;
			}
		}
		
		return $result;
	}

	public function getNoteFields(Category $item) {
		$result = [];
		
		/** @var BenchmarkField $field */
		foreach ($item->getBenchmarkFields() as $field) {
			if ($field->getNoteType() != BenchmarkField::NONE_NOTE_TYPE) {
				$result[] = $field;
			}
		}
		
		return $result;
	}

	public function getNumberFields(Category $item) {
		return $this->getFieldsByTypes($item, 
				[BenchmarkField::DECIMAL_FIELD_TYPE, BenchmarkField::INTEGER_FIELD_TYPE]);
	}

	public function getEnumFields(Category $item) {
		return $this->getFieldsByTypes($item, 
				[BenchmarkField::SINGLE_ENUM_FIELD_TYPE, BenchmarkField::MULTI_ENUM_FIELD_TYPE]);
	}

	public function getBoolFields(Category $item) {
		return $this->getFieldsByTypes($item, [BenchmarkField::BOOLEAN_FIELD_TYPE]);
	}

	public function getPriceField() {
		$field = new BenchmarkField();
		
		$field->setFieldName($this->translator->trans(self::PRICE_LABEL));
		$field->setFieldType(BenchmarkField::DECIMAL_FIELD_TYPE);
		$field->setDecimalPlaces(self::PRICE_DECIMAL_PLACES);
		
		//TODO another reason to make price filed like all others with special boolean flag -> price factor
		// $field['valueField'] = self::PRICE_FIELD;
		// $field['fieldType'] = BenchmarkField::DECIMAL_FIELD_TYPE;
		// $field['fieldName'] = $this->translator->trans(self::PRICE_LABEL);
		// $field['decimalPlaces'] = self::PRICE_DECIMAL_PLACES;
		
		return $field;
	}

	private function getFieldsByTypes(Category $item, array $types) {
		$result = [];
		
		/** @var BenchmarkField $field */
		foreach ($item->getBenchmarkFields() as $field) {
			if (in_array($field->getFieldType(), $types)) {
				$result[] = $field;
			}
		}
		
		return $result;
	}
}