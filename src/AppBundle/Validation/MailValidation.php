<?php

namespace AppBundle\Validation;

class MailValidation implements ParamValidation {

	public function isValid($param) {
		$result = ! preg_match('/[^a-zA-Z0-9-_.@]/', $param);
		$result &= preg_match('/^[^@]*@[^@]*$/', $param);
		$result &= strpos($param, '..') === false;
		
		return $result;
	}
}