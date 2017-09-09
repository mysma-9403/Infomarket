<?php

namespace Tests\AppBundle\Factory\Common\Choices\Bool;

use AppBundle\Entity\Main\BenchmarkMessage;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkMessageStatesFactory;
use PHPUnit\Framework\TestCase;

class BenchmarkMessageStatesFactoryTest extends TestCase {

	const INVALID_VALUE = - 1;

	const TWIG_FUNCTION = 'benchmarkMessageStateName';

	/**
	 *
	 * @var BenchmarkMessageStatesFactory
	 */
	protected $factory;

	protected function setUp() {
		$this->factory = new BenchmarkMessageStatesFactory();
	}

	public function testGetFunctions() {
		$result = $this->factory->getFunctions();
		
		$this->assertArrayHasKey(self::TWIG_FUNCTION, $result);
	}

	public function testGetItems() {
		$result = $this->factory->getItems();
		
		$this->assertContains(BenchmarkMessage::COMPLETED_STATE, $result);
		$this->assertContains(BenchmarkMessage::IN_PROCESS_STATE, $result);
		$this->assertContains(BenchmarkMessage::INFORMATION_REQUIRED_STATE, $result);
		$this->assertContains(BenchmarkMessage::INFORMATION_SUPPLIED_STATE, $result);
		$this->assertContains(BenchmarkMessage::REPORTED_STATE, $result);
	}

	public function testGetInvalidLabel() {
		$result = $this->factory->getItemLabel(self::INVALID_VALUE);
		
		$this->assertFalse($result);
	}
}
