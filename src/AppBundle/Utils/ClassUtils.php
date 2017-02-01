<?php

namespace AppBundle\Utils;

class ClassUtils {
	
	/**
	 * Get class name for specified class type.
	 * 
	 * @param mixed $classType (e.g <strong>Product::class</strong>)
	 * @return string (e.g <strong>product</strong>)
	 */
	public static function getClassName($classType) {
		$reflection = new \ReflectionClass($classType);
		$name = $reflection->getShortName();
		$name = preg_replace('/([A-Z])/', '_$1', $name);
		$name = strtolower($name);
		
		return substr($name, 1);
	}
	
	public static function getClean($string) {
		
		$string = preg_replace('/[&\\s]/', '-', $string);
		
		$string = preg_replace('/[ÀÁÂÃÄÅĀĂĄ]/', 'A', $string);
		$string = preg_replace('/[Æ]/', 'Ae', $string);
		$string = preg_replace('/[ÇĆĈČ]/', 'C', $string);
		$string = preg_replace('/[ÈÉÊËĒĚĘ]/', 'E', $string);
		$string = preg_replace('/[ÌÍÎÏ]/', 'I', $string);
		$string = preg_replace('/[Ł]/', 'L', $string);
		$string = preg_replace('/[ÑŃŇ]/', 'N', $string);
		$string = preg_replace('/[ÒÓÔÕÖŌ]/', 'O', $string);
		$string = preg_replace('/[Ś]/', 'S', $string);
		$string = preg_replace('/[ÙÚÛÜ]/', 'U', $string);
		$string = preg_replace('/[Ý]/', 'Y', $string);
		$string = preg_replace('/[ŹŻ]/', 'Z', $string);
		
		$string = preg_replace('/[àáâãäåāăą]/', 'a', $string);
		$string = preg_replace('/[æ]/', 'ae', $string);
		$string = preg_replace('/[çćĉč]/', 'c', $string);
		$string = preg_replace('/[èéêëēěę]/', 'e', $string);
		$string = preg_replace('/[ìíîï]/', 'i', $string);
		$string = preg_replace('/[ł]/', 'l', $string);
		$string = preg_replace('/[ñńň]/', 'n', $string);
		$string = preg_replace('/[òóôõöō]/', 'o', $string);
		$string = preg_replace('/[ś]/', 's', $string);
		$string = preg_replace('/[ùúûü]/', 'u', $string);
		$string = preg_replace('/[ýÿ]/', 'y', $string);
		$string = preg_replace('/[źż]/', 'z', $string);
		
		$string = preg_replace('/[^a-zA-Z\\d+-\/]/', '', $string);
		
		while(strpos($string, '--') !== false) {
			$string = str_replace('--', '-', $string);
		}
		
		return strtolower($string);
	}
}