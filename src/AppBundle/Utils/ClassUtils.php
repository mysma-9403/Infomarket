<?php

namespace AppBundle\Utils;

use AppBundle\Entity\Main\ArticleCategory;

class ClassUtils {

	/**
	 * Get CamelCase class name for specified class type.
	 *
	 * @param mixed $classType
	 *        	(e.g <strong>ArticleCategory::class</strong>)
	 * @return string (e.g <strong>ArticleCategory</strong>)
	 */
	public static function getCamelCaseName($type) {
		$reflection = new \ReflectionClass($type);
		
		return $reflection->getShortName();
	}

	/**
	 * Get paramCase class name for specified class type.
	 *
	 * @param mixed $classType
	 *        	(e.g <strong>ArticleCategory::class</strong>)
	 * @return string (e.g <strong>articleCategory</strong>)
	 */
	public static function getParamCaseName($type) {
		$reflection = new \ReflectionClass($type);
		
		$name = $reflection->getShortName();
		
		return strtolower(substr($name, 0, 1)) . substr($name, 1);
	}

	/**
	 * Get underscore class name for specified class type.
	 *
	 * @param mixed $classType
	 *        	(e.g <strong>ArticleCategory::class</strong>)
	 * @return string (e.g <strong>article_category</strong>)
	 */
	public static function getUnderscoreName($type) {
		$reflection = new \ReflectionClass($type);
		
		$name = $reflection->getShortName();
		$name = preg_replace('/([A-Z])/', '_$1', $name);
		$name = strtolower($name);
		
		return substr($name, 1);
	}
}