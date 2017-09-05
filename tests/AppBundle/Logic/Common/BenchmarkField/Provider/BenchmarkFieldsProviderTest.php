<?php

namespace Tests\AppBundle\Logic\Common\BenchmarkField\Provider;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Repository\Common\BenchmarkFieldMetadataRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Translation\Translator;

class BenchmarkFieldsProviderTest extends TestCase {
	
	const VALUE_FIELD= 'price';
	const PRICE_LABEL = 'price';
	
	const CATEGORY_ID = 100;
	
	const PRICE_FIELD = [
		'valueField' => self::VALUE_FIELD,
		'fieldType' => BenchmarkField::DECIMAL_FIELD_TYPE,
		'fieldName' => self::PRICE_LABEL,
		'decimalPlaces' => 2
	];
	
	
	
	public function testAllFieldsReturned() {
		$provider = new BenchmarkFieldsProvider($this->getBenchmarkAllFieldRepositoryMock(), $this->getDummyTranslatorMock());
		$provider->getAllFields(self::CATEGORY_ID);
	}
	
	public function testShowFieldsReturned() {
		$provider = new BenchmarkFieldsProvider($this->getBenchmarkShowFieldRepositoryMock(), $this->getDummyTranslatorMock());
		$provider->getShowFields(self::CATEGORY_ID);
	}
	
	public function testFilterFieldsReturned() {
		$provider = new BenchmarkFieldsProvider($this->getBenchmarkFilterFieldRepositoryMock(), $this->getDummyTranslatorMock());
		$provider->getFilterFields(self::CATEGORY_ID);
	}
	
	public function testNoteFieldsReturned() {
		$provider = new BenchmarkFieldsProvider($this->getBenchmarkNoteFieldRepositoryMock(), $this->getDummyTranslatorMock());
		$provider->getNoteFields(self::CATEGORY_ID);
	}
	
	public function testBoolFieldsReturned() {
		$provider = new BenchmarkFieldsProvider($this->getBenchmarkBoolFieldRepositoryMock(), $this->getDummyTranslatorMock());
		$provider->getBoolFields(self::CATEGORY_ID);
	}
	
	public function testEnumFieldsReturned() {
		$provider = new BenchmarkFieldsProvider($this->getBenchmarkEnumFieldRepositoryMock(), $this->getDummyTranslatorMock());
		$provider->getEnumFields(self::CATEGORY_ID);
	}
	
	public function testNumberFieldsReturned() {
		$provider = new BenchmarkFieldsProvider($this->getBenchmarkNumberFieldRepositoryMock(), $this->getDummyTranslatorMock());
		$provider->getNumberFields(self::CATEGORY_ID);
	}
	
	public function testPriceFieldReturned() {
		$provider = new BenchmarkFieldsProvider($this->getDummyRepositoryMock(), $this->getPriceTranslatorMock());
		$result = $provider->getPriceField();
		
		$this->assertEquals(self::PRICE_FIELD, $result);
	}
	
	
	
	private function getBenchmarkAllFieldRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->once())->method('findItemsByCategory');
	
		return $repository;
	}
	
	private function getBenchmarkShowFieldRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->once())->method('findShowItemsByCategory');
	
		return $repository;
	}
	
	private function getBenchmarkFilterFieldRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->once())->method('findFilterItemsByCategory');
	
		return $repository;
	}
	
	private function getBenchmarkNoteFieldRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->once())->method('findNoteItemsByCategory');
		
		return $repository;
	}
	
	private function getBenchmarkBoolFieldRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->once())->method('findBoolItemsByCategory');
	
		return $repository;
	}
	
	private function getBenchmarkEnumFieldRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->once())->method('findEnumItemsByCategory');
	
		return $repository;
	}
	
	private function getBenchmarkNumberFieldRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->once())->method('findNumberItemsByCategory');
	
		return $repository;
	}
	
	private function getDummyRepositoryMock() {
		$repository = $this->getMockBuilder ( BenchmarkFieldMetadataRepository::class )->disableOriginalConstructor ()->getMock ();
	
		return $repository;
	}
	
	
	private function getPriceTranslatorMock() {
		$repository = $this->getMockBuilder ( Translator::class )->disableOriginalConstructor ()->getMock ();
		$repository->expects($this->atMost(1))->method('trans')->willReturn(self::PRICE_LABEL);
		
		return $repository;
	}
	
	private function getDummyTranslatorMock() {
		$repository = $this->getMockBuilder ( Translator::class )->disableOriginalConstructor ()->getMock ();
		
		return $repository;
	}
}
