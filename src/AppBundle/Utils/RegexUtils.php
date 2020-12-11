<?php

namespace AppBundle\Utils;

use Symfony\Component\Validator\Constraints\Regex;

class RegexUtils {

	public function getPlainStringRegex() {
		return new Regex('/^[^0-9!@#$%^&*(),.<>;:]+$/');
	}
	
	public function getZipCodeRegex() {
		return new Regex('/^\d{2}(?:[-\s]\d{3})$/');
	}
}