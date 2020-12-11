<?php

namespace AppBundle\Validation;

class StringValidation implements ParamValidation {

	public function isValid($param) {
		return ! preg_match('/[^a-zA-Z0-9\s\/+._-]/', $param);
	}
}