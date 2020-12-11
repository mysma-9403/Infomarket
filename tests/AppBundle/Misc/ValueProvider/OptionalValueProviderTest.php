<?php

namespace Tests\AppBundle\Misc\ValueProvider;

use AppBundle\Misc\ValueProvider\OptionalValueProvider;
use AppBundle\Misc\ValueProvider\ValueProvider;
use PHPUnit\Framework\TestCase;

class OptionalValueProviderTest extends TestCase {

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
		$this->provider = new OptionalValueProvider();
	}

	public function testGivenFieldsWithKeyThenReturnValue() {
		$result = $this->provider->getValue(self::FIELDS_WITH_KEY, self::KEY);
		
		$this->assertSame(self::VALUE, $result);
	}

	public function testGivenFieldsWithNoKeyThenReturnNull() {
		$result = $this->provider->getValue(self::FIELDS_WITH_NO_KEY, self::KEY);
		
		$this->assertNull($result);
	}

	public function testGivenFieldsWithNullKeyThenReturnNull() {
		$result = $this->provider->getValue(self::FIELDS_WITH_NULL_KEY, self::KEY);
		
		$this->assertNull($result);
	}

	public function testGivenFieldsWithEmptyKeyThenReturnNull() {
		$result = $this->provider->getValue(self::FIELDS_WITH_EMPTY_KEY, self::KEY);
		
		$this->assertNull($result);
	}
}