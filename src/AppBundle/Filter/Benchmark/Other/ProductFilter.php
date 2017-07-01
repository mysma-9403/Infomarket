<?php

namespace AppBundle\Filter\Benchmark\Other;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use AppBundle\Repository\Admin\Main\BenchmarkFieldRepository;
use AppBundle\Utils\Entity\DataBase\BenchmarkFieldDataBaseUtils;

class ProductFilter extends Filter {
	
	/**
	 * 
	 * @var BenchmarkFieldRepository
	 */
	protected $benchmarkFieldRepository;
	
	/**
	 *
	 * @var integer
	 */
	protected $contextCategory = null;
	
	/**
	 * 
	 * @var array
	 */
	protected $editorFields;
	
	
	
	public function __construct(BenchmarkFieldRepository $benchmarkFieldRepository) {
		$this->benchmarkFieldRepository = $benchmarkFieldRepository;
	}
	
	public function initContextParams(array $contextParams) {
		$this->contextCategory = $contextParams['subcategory'];
		
		$this->editorFields = $this->benchmarkFieldRepository->findItemsByCategory($this->contextCategory);
		
		//TODO dependency injection - check if it can be used to not recalculate fields in ProductManager index
		for($i = 0; $i < count($this->editorFields); $i++) {
			$field = $this->editorFields[$i];
			$field['valueField'] = BenchmarkFieldDataBaseUtils::getValueFieldProperty($field['valueType'], $field['valueNumber']);
			$this->editorFields[$i] = $field;
		}
	}
	
	/**
	 * Set contextCategory
	 *
	 * @param integer $contextCategory
	 *
	 * @return ProductFilter
	 */
	public function setContextCategory($contextCategory)
	{
		$this->contextCategory = $contextCategory;
	
		return $this;
	}
	
	/**
	 * Get term contextCategory
	 *
	 * @return integer
	 */
	public function getContextCategory()
	{
		return $this->contextCategory;
	}
	
	/**
	 * Set editorFields
	 *
	 * @param array $editorFields
	 *
	 * @return ProductFilter
	 */
	public function setEditorFields($editorFields)
	{
		$this->editorFields = $editorFields;
	
		return $this;
	}
	
	/**
	 * Get editorFields
	 *
	 * @return array
	 */
	public function getEditorFields()
	{
		return $this->editorFields;
	}
}