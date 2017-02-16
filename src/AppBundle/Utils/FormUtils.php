<?php

namespace AppBundle\Utils;

class FormUtils {
	
	public static function getListLabel($value, $key, $index) {
		$index = strpos($key, ' ');
		if($index !== false) return substr($key, $index);
		else return ' ';
	}
}