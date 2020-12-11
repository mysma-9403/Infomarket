<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Utils\LabelUtils;
use PHPUnit\Framework\TestCase;

class LabelUtilsTest extends TestCase {

	const STRING = 'test';

	public function testGetLabel() {
		$result = LabelUtils::getLabel(self::STRING);
		
		$this->assertSame(LabelUtils::LABEL . self::STRING, $result);
	}
}
