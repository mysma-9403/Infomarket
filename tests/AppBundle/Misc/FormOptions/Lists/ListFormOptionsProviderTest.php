<?php

namespace Tests\AppBundle\Misc\ValueProvider;

use AppBundle\Misc\FormOptions\Lists\ListFormOptionsProvider;
use AppBundle\Misc\ValueProvider\ValueProvider;
use PHPUnit\Framework\TestCase;

class ListFormOptionsProviderTest extends TestCase {

	const LIST_ITEMS = ['10 item1' => 10];
	
	const FROM_OPTIONS = ['entriesChoices' => self::LIST_ITEMS];

	/**
	 *
	 * @var ListFormOptionsProvider
	 */
	private $provider;

	public function __construct() {
		$this->provider = new ListFormOptionsProvider();
	}

	public function testGivenListItemsThenReturnFormOptions() {
		$result = $this->provider->getFormOptions(self::LIST_ITEMS);
		
		$this->assertSame(self::FROM_OPTIONS, $result);
	}
}