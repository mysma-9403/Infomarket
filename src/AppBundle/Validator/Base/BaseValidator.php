<?php

namespace AppBundle\Validator\Base;

use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseValidator {

	const REMOVAL_VALIDATION_GROUP = 'removal';

	/**
	 *
	 * @var ValidatorInterface
	 */
	protected $validator;

	/**
	 *
	 * @var TranslatorInterface
	 */
	protected $translator;

	public function __construct(ValidatorInterface $validator, TranslatorInterface $translator) {
		$this->validator = $validator;
		$this->translator = $translator;
	}
	
	public function validateDeletedItems(array $items) {
		$errors = [];
		
		foreach ($items as $item) {
			$entryErrors = $this->validateDeletedItem($item);
			$errors = array_merge($errors, $entryErrors);
		}
		
		return $errors;
	}
	
	public function validateDeletedItem($item) {
		$errors = [];
		
		$violations = $this->validator->validate($item, null, [self::REMOVAL_VALIDATION_GROUP]);
		foreach ($violations as $violation) {
			$errors[] = $violation;
		}
		
		return $errors;
	}
}