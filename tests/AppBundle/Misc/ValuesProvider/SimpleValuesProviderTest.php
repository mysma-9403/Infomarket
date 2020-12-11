<?php

namespace Tests\AppBundle\Misc\ValuesProvider;

use AppBundle\Misc\ValueProvider\ValueProvider;
use AppBundle\Misc\ValuesProvider\ValuesProvider;
use PHPUnit\Framework\TestCase;
use AppBundle\Misc\ValuesProvider\SimpleValuesProvider;

class SimpleValuesProviderTest extends TestCase {

	const ID_KEY = 'id';

	const ID_VALUE = 17;

	const NAME_KEY = 'name';

	const NAME_VALUE = 'Test name';

	const SUBNAME_KEY = 'subname';

	const SUBNAME_VALUE = 'Test subname';

	const FIELDS = [];

	const MANDATORY_VALUES = [self::ID_VALUE, self::NAME_VALUE];

	const ALL_VALUES = [self::ID_VALUE, self::NAME_VALUE, self::SUBNAME_VALUE];

	/**
	 *
	 * @var ValuesProvider
	 */
	private $provider;

	/**
	 *
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $mandatoryValueProvider;

	/**
	 *
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $optionalValueProvider;

	public function __construct() {
		$this->mandatoryValueProvider = $this->getValueProvider();
		$this->optionalValueProvider = $this->getValueProvider();
		
		$this->provider = new SimpleValuesProvider($this->mandatoryValueProvider, $this->optionalValueProvider, 
				[self::ID_KEY, self::NAME_KEY], [self::SUBNAME_KEY]);
	}

	public function testWhenMandatoryValueProviderThrowsExceptionThenThrowException() {
		$this->expectException(\InvalidArgumentException::class);
		
		$this->mandatoryValueProvider->method('getValue')->willThrowException(new \InvalidArgumentException());
		
		$this->provider->getValues(self::FIELDS);
	}

	public function testWhenAllMandatoryProvidersReturnValueThenReturnArray() {
		$this->mandatoryValueProvider->method('getValue')->willReturnMap(
				[
						[self::FIELDS, self::ID_KEY, self::ID_VALUE], 
						[self::FIELDS, self::NAME_KEY, self::NAME_VALUE]]);
		
		$result = $this->provider->getValues(self::FIELDS);
		
		$this->assertSame(self::MANDATORY_VALUES, $result);
	}

	public function testWhenAllProvidersReturnValueThenReturnArray() {
		$this->mandatoryValueProvider->method('getValue')->willReturnMap(
				[
						[self::FIELDS, self::ID_KEY, self::ID_VALUE], 
						[self::FIELDS, self::NAME_KEY, self::NAME_VALUE]]);
		$this->optionalValueProvider->method('getValue')->willReturnMap(
				[[self::FIELDS, self::SUBNAME_KEY, self::SUBNAME_VALUE]]);
		
		$result = $this->provider->getValues(self::FIELDS);
		
		$this->assertSame(self::ALL_VALUES, $result);
	}

	private function getValueProvider() {
		$mock = $this->getMockBuilder(ValueProvider::class)->disableOriginalConstructor()->getMock();
		
		return $mock;
	}
}
