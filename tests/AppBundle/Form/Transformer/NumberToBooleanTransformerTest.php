<?php

namespace Tests\AppBundle\Form\Transformer;

use AppBundle\Form\Transformer\NumberToBooleanTransformer;
use PHPUnit\Framework\TestCase;

class NumberToBooleanTransformerTest extends TestCase {
	
	private $transformer;
	
	
	
	public function __construct() {
		$this->transformer = new NumberToBooleanTransformer();
	}
	
	
	
	public function testGivenPositiveThenTrue() {
		$result = $this->transformer->transform(113);
		
		$this->assertEquals(true, $result);
	}
	
	public function testGivenZeroThenFalse() {
		$result = $this->transformer->transform(0);
	
		$this->assertEquals(false, $result);
	}
	
	public function testGivenNegativeThenFalse() {
		$result = $this->transformer->transform(-17);
	
		$this->assertEquals(false, $result);
	}
}
