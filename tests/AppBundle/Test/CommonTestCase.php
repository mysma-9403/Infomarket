<?php

namespace Tests\AppBundle\Test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\TranslatorInterface;

class CommonTestCase extends TestCase {

	protected function getTranslatorMock() {
		$mock = $this->getMockBuilder(TranslatorInterface::class)->disableOriginalConstructor()->getMock();
		
		$mock->expects($this->any())->method('trans')->willReturnCallback(
				function ($string) {
					return $string;
				});
		
		return $mock;
	}
}