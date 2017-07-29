<?php

namespace Tests\TestUtils;



class TestUtils {
	
	//TODO remove
	public static function getMethod($class, $name) {
		$class = new \ReflectionClass ( $class );
		
		$method = $class->getMethod ( $name );
		$method->setAccessible ( true );
		
		return $method;
	}
}
