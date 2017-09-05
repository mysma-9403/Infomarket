<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsSeparatorValidator extends ConstraintValidator {

	protected $separator = '#';

	public function validate($value, Constraint $constraint) {
		if (strpos($value, $this->separator) !== false) {
			$this->context->buildViolation($constraint->message)->setParameter('%separator%', $this->separator)->addViolation();
		}
	}
}