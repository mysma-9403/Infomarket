<?php

namespace AppBundle\Utils;

class ParamUtils {
	
	const CHOICES = 'Choices';
	
	public static function getChoicesName($name) {
		return $name . self::CHOICES;
	}
}