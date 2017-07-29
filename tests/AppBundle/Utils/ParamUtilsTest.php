<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Utils\ParamUtils;
use PHPUnit\Framework\TestCase;

class ParamUtilsTest extends TestCase {
	
	const NAME = 'test';
	
	
	
	public function testGetChoicesName() {
		$result = ParamUtils::getChoicesName(self::NAME);
	
		$this->assertSame(self::NAME . ParamUtils::CHOICES, $result);
	}
}
