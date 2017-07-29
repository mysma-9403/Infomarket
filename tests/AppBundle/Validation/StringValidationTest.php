<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Validation\ParamValidation;
use AppBundle\Validation\StringValidation;
use PHPUnit\Framework\TestCase;

class StringValidationTest extends TestCase {
	
	/**
	 * 
	 * @var ParamValidation
	 */
	protected $validation;
	
	
	protected function setUp() {
		$this->validation = new StringValidation();
	}
	
	
	
	public function testIsEmptyStringValid() {
		$this->isStringValid('', true);
	}
	
	public function testIsSimpleStringValid() {
		$this->isStringValid('Test', true);
	}
	
	public function testIsSpacedStringValid() {
		$this->isStringValid('Test string', true);
	}
	
	public function testIsPausedStringValid() {
		$this->isStringValid('Test-string', true);
	}
	
	public function testIsPlusStringValid() {
		$this->isStringValid('Whirlpool+', true);
	}
	
	public function testIsPathStringValid() {
		$this->isStringValid('Test/String', true);
	}
	
	public function testIsDecimalStringValid() {
		$this->isStringValid('Test01', true);
	}
	
	public function testIsDottedStringValid() {
		$this->isStringValid('Test.string', true);
	}
	
	public function testIsUnderscoredStringValid() {
		$this->isStringValid('Test_string', true);
	}
	
	
	
	public function testIsNonAsciiStringValid() {
		$this->isStringValid('Tęst', false);
	}
	
	public function testIsCommaStringValid() {
		$this->isStringValid('Test,string', false);
	}
	
	public function testIsSemicolonStringValid() {
		$this->isStringValid('Test;string', false);
	}
	
	public function testIsExclamationStringValid() {
		$this->isStringValid('Test!', false);
	}
	
	
	
	protected function isStringValid($string, $valid) {
		$value = $this->validation->isValid($string);
		
		$this->assertEquals($valid, $value);
	}
}
