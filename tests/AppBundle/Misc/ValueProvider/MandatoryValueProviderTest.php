<?php

namespace Tests\AppBundle\Misc\ValueProvider;

use AppBundle\Misc\ValueProvider\MandatoryValueProvider;
use AppBundle\Misc\ValueProvider\ValueProvider;
use PHPUnit\Framework\TestCase;

class MandatoryValueProviderTest extends TestCase {

	const KEY = "id";

	const VALUE = 10;

	const FIELDS_WITH_KEY = [self::KEY => self::VALUE];

	const FIELDS_WITH_NO_KEY = [];

	const FIELDS_WITH_NULL_KEY = [self::KEY => null];

	const FIELDS_WITH_EMPTY_KEY = [self::KEY => ''];

	/**
	 *
	 * @var ValueProvider
	 */
	private $provider;

	public function __construct() {
		$this->provider = new MandatoryValueProvider();
	}

	public function testGivenFieldsWithKeyThenReturnValue() {
		$result = $this->provider->getValue(self::FIELDS_WITH_KEY, self::KEY);
		
		$this->assertSame(self::VALUE, $result);
	}

	public function testGivenFieldsWithNoKeyThenThrowException() {
		$this->expectException(\InvalidArgumentException::class);
		
		$this->provider->getValue(self::FIELDS_WITH_NO_KEY, self::KEY);
	}

	public function testGivenFieldsWithNullKeyThenReturnNull() {
		$this->expectException(\InvalidArgumentException::class);
		
		$this->provider->getValue(self::FIELDS_WITH_NULL_KEY, self::KEY);
	}

	public function testGivenFieldsWithEmptyKeyThenReturnNull() {
		$this->expectException(\InvalidArgumentException::class);
		
		$this->provider->getValue(self::FIELDS_WITH_EMPTY_KEY, self::KEY);
	}
}