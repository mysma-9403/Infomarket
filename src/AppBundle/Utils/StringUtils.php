<?php

namespace AppBundle\Utils;

class StringUtils extends \Twig_Extension {
	
	public static function getCleanName($string) {
	
		$string = preg_replace('/[&\\s]/', '-', $string);
	
		$string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
	
		$string = preg_replace('/[^a-zA-Z\\d+-]/', '', $string);
	
		$string = preg_replace('/(-)\\1+/', '$1', $string);
	
		return strtolower($string);
	}
	
	public static function getCleanPath($string) {
		
		$string = preg_replace('/[&\\s]/', '-', $string);
		
		$string = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
		
		$string = preg_replace('/[^a-zA-Z\\d+-\/]/', '', $string);
		
		$string = preg_replace('/(-)\\1+/', '$1', $string);
		$string = preg_replace('/\/-/', '/', $string);
		$string = preg_replace('/\/\//', '/', $string);
		
		return strtolower($string);
	}
	
	public function getFilters() {
		$filters = array();
		
		$filters['cleanName'] = new \Twig_SimpleFilter('cleanName', StringUtils::class . '::getCleanName');
		
		return $filters;
	}
}