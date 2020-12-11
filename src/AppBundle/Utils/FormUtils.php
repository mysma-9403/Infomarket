<?php

namespace AppBundle\Utils;

class FormUtils {

	public static function getChoiceLabel($value, $key, $index) {
		$index = strpos($key, ' ');
		if ($index !== false)
			return substr($key, $index + 1);
		else
			return ' ';
	}
}