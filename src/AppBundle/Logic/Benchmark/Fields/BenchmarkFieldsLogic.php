<?php

namespace AppBundle\Logic\Benchmark\Fields;

use AppBundle\Repository\Benchmark\BenchmarkFieldRepository;
use AppBundle\Repository\Benchmark\ProductRepository;

class BenchmarkFieldsLogic {
	
	/**
	 * 
	 * @var BenchmarkFieldRepository
	 */
	protected $benchmarkFieldRepository;
	
	/**
	 *
	 * @var ProductRepository
	 */
	protected $productRepository;
	
	/**
	 * 
	 * @var integer
	 */
	protected $categoryId;
	
	/**
	 * 
	 * @var BenchmarkFieldLogic
	 */
	protected $logic;
	
	public function __construct(BenchmarkFieldRepository $benchmarkFieldRepository, ProductRepository $productRepository, $categoryId) {
		$this->benchmarkFieldRepository = $benchmarkFieldRepository;
		$this->productRepository = $productRepository;
		
		$this->categoryId = $categoryId;
		
		$this->logic = new BenchmarkFieldLogic($productRepository, $categoryId);
	}
	
	
	
	public function getBenchmarkNumberFields() {
		$fields = $this->benchmarkFieldRepository->findNumberItemsByCategory($this->categoryId);
		 
		for ($i = 0; $i < count($fields); $i++) {
			$field = $fields[$i];
	
			$field = $this->logic->initValueField($field);
    		$field = $this->logic->initMinMaxAvgValues($field);
    		$field = $this->logic->initModeValue($field);
    		$field = $this->logic->initMeanValue($field);
	
			$fields[$i] = $field;
		}
		 
		return $fields;
	}
	
	public function getBenchmarkEnumFields() {
		$fields = $this->benchmarkFieldRepository->findEnumItemsByCategory($this->categoryId);
    	
    	for ($i = 0; $i < count($fields); $i++) {
    		$field = $fields[$i];
    		
    		$field = $this->logic->initValueField($field);
    		$field = $this->logic->initEnumValues($field);
    		
    		$fields[$i] = $field;
    	}
    	
    	return $fields;
	}
	
	public function getBenchmarkBoolFields() {
		$fields = $this->benchmarkFieldRepository->findBoolItemsByCategory($this->categoryId);
		
		for ($i = 0; $i < count($fields); $i++) {
			$field = $fields[$i];
		
			$field = $this->logic->initValueField($field);
			$field = $this->logic->initTrueValuesCount($field);
		
			$fields[$i] = $field;
		}
		
		return $fields;
	}
	
	public function getBenchmarkPriceField() {
		$field = array();
		
		$field['valueField'] = 'price';
		$field['fieldName'] = 'Cena [PLN]'; //TODO translator :) :(
		$field['decimalPlaces'] = 2;

		$field = $this->logic->initMinMaxAvgValues($field);
		$field = $this->logic->initModeValue($field);
		$field = $this->logic->initMeanValue($field);
		
		return $field;
	}
}