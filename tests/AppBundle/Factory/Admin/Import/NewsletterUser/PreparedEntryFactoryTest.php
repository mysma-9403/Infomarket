<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Factory\Admin\ErrorFactory;
use AppBundle\Factory\Admin\Import\NewsletterUser\ImportErrorFactory;
use AppBundle\Factory\Admin\Import\NewsletterUser\PreparedEntryFactory;
use Tests\AppBundle\Test\CommonTestCase;
use AppBundle\Validation\ParamValidation;

class PreparedEntryFactoryTest extends CommonTestCase {
	/**
	 *
	 * @var ImportErrorFactory $errorFactory
	 */
	protected $errorFactory;
	
	/**
	 *
	 * @var PreparedEntryFactory $entryFactory
	 */
	protected $entryFactory;
	
	//TODO refactor Error Factory -> should be mocked
	protected function setUp() {
		$this->errorFactory = new ImportErrorFactory ($this->getTranslatorMock());
		$this->entryFactory = new PreparedEntryFactory($this->errorFactory, $this->getMailValidationMock());
	}
	
	public function testGetEntriesSubscribed01() {
		$this->getRowEntries ( [ 
				'test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSubscribed02() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				0 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSubscribed03() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				'0' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSubscribed04() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				'-' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSubscribed05() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				'false' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSubscribedList01() {
		$this->getRowEntries ( [ 
				'test@wp.pl;test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => true 
				],
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSubscribedList02() {
		$this->getRowEntries ( [ 
				'test1@wp.pl;test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => true 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSubscribedList03() {
		$this->getRowEntries ( [ 
				'test1@wp.pl; test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => true 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesUnsubscribed01() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				1 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesUnsubscribed02() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				'1' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesUnsubscribed03() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				'+' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesUnsubscribed04() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				'true' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesUnsubscribed05() {
		$this->getRowEntries ( [ 
				'test@wp.pl',
				'asd' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesUnsubscribedList01() {
		$this->getRowEntries ( [ 
				'test@wp.pl;test@wp.pl',
				'1' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja01() {
		$this->getRowEntries ( [ 
				'rezygnacja_test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja02() {
		$this->getRowEntries ( [ 
				'rezygnacja-test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja03() {
		$this->getRowEntries ( [ 
				'rezygnacja test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja11() {
		$this->getRowEntries ( [ 
				'Rezygnacja_test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja12() {
		$this->getRowEntries ( [ 
				'REzygnacja-test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja13() {
		$this->getRowEntries ( [ 
				'rEzygnacja test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja21() {
		$this->getRowEntries ( [ 
				'test@wp.pl_rezygnacja' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja22() {
		$this->getRowEntries ( [ 
				'test@wp.pl-rezygnacja' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja23() {
		$this->getRowEntries ( [ 
				'test@wp.pl rezygnacja' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja31() {
		$this->getRowEntries ( [ 
				'test@wp.pl_Rezygnacja' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja32() {
		$this->getRowEntries ( [ 
				'test@wp.pl-REzygnacja' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezygnacja33() {
		$this->getRowEntries ( [ 
				'test@wp.pl rEzygnacja' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez01() {
		$this->getRowEntries ( [ 
				'rez_test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez02() {
		$this->getRowEntries ( [ 
				'rez-test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez03() {
		$this->getRowEntries ( [ 
				'rez test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez11() {
		$this->getRowEntries ( [ 
				'Rez_test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez12() {
		$this->getRowEntries ( [ 
				'Rez-test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez13() {
		$this->getRowEntries ( [ 
				'Rez test@wp.pl' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez21() {
		$this->getRowEntries ( [ 
				'test@wp.pl_rez' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez22() {
		$this->getRowEntries ( [ 
				'test@wp.pl-rez' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez23() {
		$this->getRowEntries ( [ 
				'test@wp.pl rez' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez31() {
		$this->getRowEntries ( [ 
				'test@wp.pl_REZ' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez32() {
		$this->getRowEntries ( [ 
				'test@wp.pl-REz' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRez33() {
		$this->getRowEntries ( [ 
				'test@wp.pl reZ' 
		], array (
				[ 
						'mail' => 'test@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezList01() {
		$this->getRowEntries ( [ 
				'rez_test1@wp.pl;test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesRezList02() {
		$this->getRowEntries ( [ 
				'rez_test1@wp.pl; test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesRezList03() {
		$this->getRowEntries ( [ 
				'rez_test1@wp.pl;rez_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezList04() {
		$this->getRowEntries ( [ 
				'rez_test1@wp.pl; rez_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezList05() {
		$this->getRowEntries ( [ 
				'rez_test1@wp.pl; rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezList06() {
		$this->getRowEntries ( [ 
				'test1@wp.pl_rez; rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezList07() {
		$this->getRowEntries ( [ 
				'test1@wp.pl_rezygnacja; rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesRezList08() {
		$this->getRowEntries ( [ 
				'test1@wp.pl_rezygnacja; test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesRezList09() {
		$this->getRowEntries ( [ 
				'test1@wp.pl; rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => true 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesColon01() {
		$this->getRowEntries ( [ 
				'rez_test1@wp.pl,test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesColon02() {
		$this->getRowEntries ( [ 
				'rez_test1@wp.pl, test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => false 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesColon03() {
		$this->getRowEntries ( [ 
				'test1@wp.pl, rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => true 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesDoubleColon() {
		$this->getRowEntries ( [ 
				'test1@wp.pl,, rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => true 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesDoubleSemicolon() {
		$this->getRowEntries ( [ 
				'test1@wp.pl;; rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl',
						'subscribed' => true 
				],
				[ 
						'mail' => 'test2@wp.pl',
						'subscribed' => false 
				] 
		) );
	}
	public function testGetEntriesSpace01() {
		$this->getRowEntries ( [ 
				'test1@wp.pl test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	public function testGetEntriesSpace02() {
		$this->getRowEntries ( [ 
				'test1@wp.pl rezygnacja_test2@wp.pl' 
		], array (
				[ 
						'mail' => 'test1@wp.pl rezygnacja_test2@wp.pl',
						'subscribed' => true 
				] 
		) );
	}
	protected function getRowEntries($fileEntry, $expected) {
		$result = $this->entryFactory->getRowEntries ( $fileEntry, 9 );
		
		$this->assertEquals ( count ( $expected ), count ( $result ) );
		
		for($i = 0; $i < count ( $result ); $i ++) {
			$expectedEntry = $expected [$i];
			$resultEntry = $result [$i];
			
			$this->assertEquals ( $expectedEntry ['mail'], $resultEntry ['mail'] );
			$this->assertEquals ( $expectedEntry ['subscribed'], $resultEntry ['subscribed'] );
		}
	}
	
	private function getMailValidationMock() {
		$mock = $this->getMockBuilder(ParamValidation::class)->disableOriginalConstructor()->getMock();
	
		$mock->expects($this->any())->method('isValid')->willReturn(true);
	
		return $mock;
	}
}
