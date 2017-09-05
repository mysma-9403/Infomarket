<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class ContainsSeparator extends Constraint {

	public $message = 'The \'%separator%\' character cannot be used due to technical restrictions.';
}