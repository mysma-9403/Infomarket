<?php

namespace AppBundle\Utils;

class StringUtils extends \Twig_Extension {
	
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
		
		$string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
		$string = iconv('UTF-8', 'UTF-8//IGNORE', $string);
		
		$string = preg_replace('/[^a-zA-Z\\d+-\/]/', '', $string);
		
		while(strpos($string, '--') !== false) {
			$string = str_replace('--', '-', $string);
		}
		
		return strtolower($string);
	}
	
	public static function getCleanName($string) {
	
		$string = preg_replace('/[&\\s]/', '-', $string);
	
		$string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
		$string = iconv('UTF-8', 'UTF-8//IGNORE', $string);
	
		$string = preg_replace('/[^a-zA-Z\\d+-]/', '', $string);
	
		while(strpos($string, '--') !== false) {
			$string = str_replace('--', '-', $string);
		}
	
		return strtolower($string);
	}
	
	public static function getCleanMail($string) {
	
		$string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
		$string = iconv('UTF-8', 'UTF-8//IGNORE', $string);
	
		$string = preg_replace('/[^a-zA-Z0-9-_.@]/', '', $string);
	
		return strtolower($string);
	}
	
	public static function isStringValid($string) {
		return !preg_match('/[^a-zA-Z0-9.\\d\\s+-_\/]/', $string);
	}
	
	public static function isMailValid($string) {
		$result = !preg_match('/[^a-zA-Z0-9-_.@]/', $string);
		$result &= preg_match('/^[^@]*@[^@]*$/', $string);
		$result &= strpos($string, '..') === false;
		
		return $result;
	}
	
	public function getFilters() {
		$filters = array();
		
		$filters['cleanName'] = new \Twig_SimpleFilter('cleanName', StringUtils::class . '::getCleanName');
		
		return $filters;
	}
}