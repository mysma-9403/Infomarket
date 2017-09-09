<?php

namespace Tests\AppBundle\Misc\ValuesProvider;

use AppBundle\Misc\ListItemsProvider\IdListItemsProvider;
use AppBundle\Misc\ListItemsProvider\ListItemsProvider;
use AppBundle\Misc\ValueProvider\ValueProvider;
use AppBundle\Misc\ValuesProvider\ValuesProvider;
use PHPUnit\Framework\TestCase;

class IdListItemsProviderTest extends TestCase {

	const ID_KEY = 'id';

	const ID_VALUE_1 = 17;

	const ID_VALUE_2 = 32;

	const NAME_VALUE_1 = "Test name 1";

	const NAME_VALUE_2 = "Test name 2";

	const ITEM_1 = [self::ID_KEY => self::ID_VALUE_1];

	const ITEM_2 = [self::ID_KEY => self::ID_VALUE_2];

	const ITEMS = [self::ITEM_1, self::ITEM_2];

	const VALUES_1 = [self::ID_VALUE_1, self::NAME_VALUE_1];

	const VALUES_2 = [self::ID_VALUE_2, self::NAME_VALUE_2];

	const LIST_ITEMS = [self::ID_VALUE_1 . ' ' . self::NAME_VALUE_1 => self::ID_VALUE_1, 
			self::ID_VALUE_2 . ' ' . self::NAME_VALUE_2 => self::ID_VALUE_2];

	/**
	 *
	 * @var ListItemsProvider
	 */
	private $provider;

	/**
	 *
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $valuesProvider;

	/**
	 *
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $valueProvider;

	public function __construct() {
		$this->valuesProvider = $this->getValuesProvider();
		$this->valueProvider = $this->getValueProvider();
		
		$this->provider = new IdListItemsProvider($this->valuesProvider, $this->valueProvider);
	}

	public function testWhenValueProviderThrowsExceptionThenThrowException() {
		$this->expectException(\InvalidArgumentException::class);
		
		$this->valueProvider->method('getValue')->willThrowException(new \InvalidArgumentException());
		
		$this->provider->getListItems(self::ITEMS);
	}

	public function testWhenAllValueProvidersReturnValueThenReturnArray() {
		$this->valueProvider->method('getValue')->willReturnMap(
				[[self::ITEM_1, self::ID_KEY, self::ID_VALUE_1], 
						[self::ITEM_2, self::ID_KEY, self::ID_VALUE_2]]);
		
		$this->valuesProvider->method('getValues')->willReturnMap(
				[[self::ITEM_1, self::VALUES_1], [self::ITEM_2, self::VALUES_2]]);
		
		$result = $this->provider->getListItems(self::ITEMS);
		
		$this->assertSame(self::LIST_ITEMS, $result);
	}

	private function getValuesProvider() {
		$mock = $this->getMockBuilder(ValuesProvider::class)->disableOriginalConstructor()->getMock();
		
		return $mock;
	}

	private function getValueProvider() {
		$mock = $this->getMockBuilder(ValueProvider::class)->disableOriginalConstructor()->getMock();
		
		return $mock;
	}
}
