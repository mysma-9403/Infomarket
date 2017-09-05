<?php

namespace AppBundle\Logic\Common\BenchmarkField\Provider;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Repository\Common\BenchmarkFieldMetadataRepository;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\TranslatorInterface;

class BenchmarkFieldsProvider {

	const PRICE_FIELD = 'price';

	const PRICE_LABEL = 'label.price';

	const PRICE_DECIMAL_PLACES = 2;

	/**
	 *
	 * @var BenchmarkFieldMetadataRepository
	 */
	protected $repository;

	/**
	 *
	 * @var TranslatorInterface
	 */
	protected $translator;

	public function __construct(BenchmarkFieldMetadataRepository $benchmarkFieldMetadataRepository, 
			TranslatorInterface $translator) {
		$this->repository = $benchmarkFieldMetadataRepository;
		$this->translator = $translator;
	}

	public function getAllFields($categoryId) {
		return $this->repository->findItemsByCategory($categoryId);
	}

	public function getShowFields($categoryId) {
		return $this->repository->findShowItemsByCategory($categoryId);
	}

	public function getFilterFields($categoryId) {
		return $this->repository->findFilterItemsByCategory($categoryId);
	}

	public function getNoteFields($categoryId) {
		return $this->repository->findNoteItemsByCategory($categoryId);
	}

	public function getNumberFields($categoryId) {
		return $this->repository->findNumberItemsByCategory($categoryId);
	}

	public function getEnumFields($categoryId) {
		return $this->repository->findEnumItemsByCategory($categoryId);
	}

	public function getBoolFields($categoryId) {
		return $this->repository->findBoolItemsByCategory($categoryId);
	}

	public function getPriceField() {
		$field = [ ];
		
		$field['valueField'] = self::PRICE_FIELD;
		$field['fieldType'] = BenchmarkField::DECIMAL_FIELD_TYPE;
		$field['fieldName'] = $this->translator->trans(self::PRICE_LABEL);
		$field['decimalPlaces'] = self::PRICE_DECIMAL_PLACES;
		
		return $field;
	}
}