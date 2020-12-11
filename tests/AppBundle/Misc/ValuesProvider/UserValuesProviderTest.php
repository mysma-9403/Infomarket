<?php

namespace Tests\AppBundle\Misc\ValuesProvider;

use AppBundle\Misc\ValueProvider\ValueProvider;
use AppBundle\Misc\ValuesProvider\UserValuesProvider;
use AppBundle\Misc\ValuesProvider\ValuesProvider;
use PHPUnit\Framework\TestCase;

class UserValuesProviderTest extends TestCase {

	const ID_VALUE = 13;

	const PSEUDONYM_VALUE = 'Test pseudonym';

	const SURNAME_VALUE = 'Test surname';

	const FORENAME_VALUE = 'Test forename';

	const USERNAME_VALUE = 'Test username';

	const FIELDS = [];

	const PSEUDONYM_VALUES = [self::ID_VALUE, self::PSEUDONYM_VALUE];

	const SURNAME_VALUES = [self::ID_VALUE, self::SURNAME_VALUE];

	const FORENAME_VALUES = [self::ID_VALUE, self::FORENAME_VALUE];

	const SURNAME_FORENAME_VALUES = [self::ID_VALUE, self::SURNAME_VALUE, self::FORENAME_VALUE];

	const USERNAME_VALUES = [self::ID_VALUE, self::USERNAME_VALUE];

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
		
		$this->provider = new UserValuesProvider($this->mandatoryValueProvider, $this->optionalValueProvider);
	}

	public function testGivenNoFieldThenThrowException() {
		$this->expectException(\InvalidArgumentException::class);
		
		$this->optionalValueProvider->method('getValue')->willReturn(null);
		$this->mandatoryValueProvider->method('getValue')->willReturnCallback([$this, 'getMandatoryValue']);
		
		$this->provider->getValues(self::FIELDS);
	}

	public function testGivenNoOptionalFieldThenReturnUsername() {
		$this->given(null, null, null, self::USERNAME_VALUE);
		
		$result = $this->provider->getValues(self::FIELDS);
		
		$this->assertSame(self::USERNAME_VALUES, $result);
	}

	public function testGivenForenameThenReturnForename() {
		$this->given(null, null, self::FORENAME_VALUE, self::USERNAME_VALUE);
		
		$result = $this->provider->getValues(self::FIELDS);
		
		$this->assertSame(self::FORENAME_VALUES, $result);
	}

	public function testGivenSurnameThenReturnSurname() {
		$this->given(null, self::SURNAME_VALUE, null, self::USERNAME_VALUE);
		
		$result = $this->provider->getValues(self::FIELDS);
		
		$this->assertSame(self::SURNAME_VALUES, $result);
	}

	public function testGivenSurnameForenameThenReturnSurnameForename() {
		$this->given(null, self::SURNAME_VALUE, self::FORENAME_VALUE, self::USERNAME_VALUE);
		
		$result = $this->provider->getValues(self::FIELDS);
		
		$this->assertSame(self::SURNAME_FORENAME_VALUES, $result);
	}

	public function testGivenPseudonymThenReturnPseudonym() {
		$this->given(self::PSEUDONYM_VALUE, self::SURNAME_VALUE, self::FORENAME_VALUE, self::USERNAME_VALUE);
		
		$result = $this->provider->getValues(self::FIELDS);
		
		$this->assertSame(self::PSEUDONYM_VALUES, $result);
	}

	private function getValueProvider() {
		$mock = $this->getMockBuilder(ValueProvider::class)->disableOriginalConstructor()->getMock();
		
		return $mock;
	}

	private function given($pseudonym, $surname, $forename, $username) {
		$this->optionalValueProvider->method('getValue')->willReturnMap(
				[
						[self::FIELDS, UserValuesProvider::SURNAME_KEY, $surname], 
						[self::FIELDS, UserValuesProvider::FORENAME_KEY, $forename], 
						[self::FIELDS, UserValuesProvider::PSEUDONYM_KEY, $pseudonym]]);
		$this->mandatoryValueProvider->method('getValue')->willReturnMap(
				[
						[self::FIELDS, UserValuesProvider::ID_KEY, self::ID_VALUE], 
						[self::FIELDS, UserValuesProvider::USERNAME_KEY, $username]]);
	}

	public function getMandatoryValue(array $fields, $key) {
		if ($key == UserValuesProvider::ID_KEY) {
			return self::ID_VALUE;
		}
		if ($key == UserValuesProvider::USERNAME_KEY) {
			throw new \InvalidArgumentException();
		}
	}
}
