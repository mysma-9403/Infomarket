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
}