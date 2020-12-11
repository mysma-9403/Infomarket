<?php

namespace AppBundle\Filter\Common\Other;

use AppBundle;
use AppBundle\Filter\Base\Filter;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Repository\Base\BaseRepository;

class ProductFilter extends Filter {

	/**
	 *
	 * @var BenchmarkFieldsProvider
	 */
	protected $benchmarkFieldsProvider;

	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $benchmarkFieldsInitializer;

	/**
	 *
	 * @var integer
	 */
	protected $contextCategory = null;

	/**
	 *
	 * @var BaseRepository
	 */
	protected $categoryRepository;
	
	/**
	 *
	 * @var array
	 */
	protected $editorFields = [];

	public function __construct(BenchmarkFieldsProvider $benchmarkFieldsProvider, 
			BenchmarkFieldsInitializer $benchmarkFieldsInitializer, BaseRepository $categoryRepository) {
		$this->benchmarkFieldsProvider = $benchmarkFieldsProvider;
		$this->benchmarkFieldsInitializer = $benchmarkFieldsInitializer;
		$this->categoryRepository = $categoryRepository;
	}

	public function initContextParams(array $contextParams) {
		if (key_exists('subcategory', $contextParams)) {
			$this->contextCategory = $contextParams['subcategory'];
		} elseif (key_exists('category', $contextParams)) {
			$this->contextCategory = $contextParams['category'];
		}
		
		// TODO check if it can be used to not recalculate fields in ProductManager index
		if ($this->contextCategory) {
			$category = $this->categoryRepository->find($this->contextCategory);
			
			$fields = $this->benchmarkFieldsProvider->getAllFields($category);
			$this->editorFields = $this->benchmarkFieldsInitializer->init($fields);
		}
	}

	public function setContextCategory($contextCategory) {
		$this->contextCategory = $contextCategory;
		
		return $this;
	}

	public function getContextCategory() {
		return $this->contextCategory;
	}

	public function setEditorFields($editorFields) {
		$this->editorFields = $editorFields;
		
		return $this;
	}

	public function getEditorFields() {
		return $this->editorFields;
	}
}