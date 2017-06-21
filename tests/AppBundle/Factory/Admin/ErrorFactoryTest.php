<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Factory\Admin\ErrorFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tests\TestUtils\TestUtils;

class ErrorFactoryTest extends WebTestCase {
	/**
	 *
	 * @var ErrorFactory
	 */
	protected $factory;
	protected $insertParam;
	protected function setUp() {
		self::bootKernel ();
		
		$translator = static::$kernel->getContainer ()->get ( 'translator' );
		$this->factory = new ErrorFactory ( $translator );
		
		$this->insertParam = TestUtils::getMethod ( ErrorFactory::class, 'insertParam' );
	}
	public function testInsertParamNull() {
		$this->insertParam ( 'This is test %param%.', '%param%', null, 'This is test .' );
	}
	public function testInsertParamInt() {
		$this->insertParam ( 'This is test %param%.', '%param%', 10, 'This is test <strong>10</strong>.' );
	}
	public function testInsertParamFloat() {
		$this->insertParam ( 'This is test %param%.', '%param%', 15.576, 'This is test <strong>15.576</strong>.' );
	}
	public function testInsertParamString() {
		$this->insertParam ( 'This is test %param%.', '%param%', 'value', 'This is test <strong>value</strong>.' );
	}
	public function testInsertParamSpaceString() {
		$this->insertParam ( 'This is test %param%.', '%param%', ' ', 'This is test .' );
	}
	public function testInsertParamEmptyString() {
		$this->insertParam ( 'This is test %param%.', '%param%', '', 'This is test .' );
	}
	protected function insertParam($message, $name, $value, $expected) {
		$result = $this->insertParam->invokeArgs ( $this->factory, array (
				$message,
				$name,
				$value 
		) );
		
		$this->assertEquals ( $expected, $result );
	}
	public function testCreateLineErrorNull() {
		$this->createLineError ( null );
	}
	public function testCreateLineErrorZero() {
		$this->createLineError ( 0 );
	}
	public function testCreateLineErrorNegative() {
		$this->createLineError ( - 1 );
	}
	public function testCreateLineErrorPositive() {
		$this->createLineError ( 17 );
	}
	protected function createLineError($number) {
		$result = $this->factory->createLineError ( $number );
		
		if ($number) {
			$this->assertEquals ( true, strpos ( $result, '<strong>' . $number . '</strong>' ) !== false );
		} else {
			$this->assertEquals ( true, strpos ( $result, '<strong></strong>' ) === false );
		}
	}
	public function testCreateLinesErrorNullNull() {
		$this->createLinesError ( null, null );
	}
	public function testCreateLinesErrorPositiveNull() {
		$this->createLinesError ( 10, null );
	}
	public function testCreateLinesErrorNullPositive() {
		$this->createLinesError ( null, 21 );
	}
	public function testCreateLinesErrorPositivePositive() {
		$this->createLinesError ( 14, 77 );
	}
	public function testCreateLinesErrorPositiveNegative() {
		$this->createLinesError ( 114, - 903 );
	}
	protected function createLinesError($prev, $next) {
		$result = $this->factory->createLinesError ( $prev, $next );
		
		if ($prev && $next) {
			$this->assertEquals ( true, strpos ( $result, '<strong>' . $prev . '</strong>' ) !== false );
			$this->assertEquals ( true, strpos ( $result, '<strong>' . $next . '</strong>' ) !== false );
		} else {
			$this->assertEquals ( true, strpos ( $result, '<strong></strong>' ) === false );
		}
	}
}
