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
	
	public static function getCleanPath($string) {
		
		$string = preg_replace('/[&\\s]/', '-', $string);
		
		$string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
		
		$string = preg_replace('/[^a-zA-Z\\d+-\/]/', '', $string);
		
		while(strpos($string, '--') !== false) {
			$string = str_replace('--', '-', $string);
		}
		
		return strtolower($string);
	}
	
	public static function getCleanName($string) {
	
		$string = preg_replace('/[&\\s]/', '-', $string);
	
		$string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
	
		$string = preg_replace('/[^a-zA-Z\\d+-]/', '', $string);
	
		while(strpos($string, '--') !== false) {
			$string = str_replace('--', '-', $string);
		}
	
		return strtolower($string);
	}
	
	public static function isStringValid($string) {
		return !preg_match('/[^a-zA-Z0-9.\\d\\s+-_\/]/', $string);
	}
}