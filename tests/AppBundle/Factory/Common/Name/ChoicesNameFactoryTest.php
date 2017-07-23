<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Factory\Common\Name\ChoicesNameFactory;
use AppBundle\Factory\Common\Name\NameFactory;
use PHPUnit\Framework\TestCase;

class ChoicesNameFactoryTest extends TestCase {
	
	const NAME = 'test';
	
	/**
	 * 
	 * @var NameFactory
	 */
	protected $factory;
	
	
	
	protected function setUp() {
		$this->factory = new ChoicesNameFactory();
	}
	
	
	
	public function testGetName() {
		$result = $this->factory->getName(self::NAME);
	
		$this->assertSame(self::NAME . ChoicesNameFactory::CHOICES, $result);
	}
}
