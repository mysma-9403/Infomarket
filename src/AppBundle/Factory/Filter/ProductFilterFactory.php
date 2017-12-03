<?php

namespace AppBundle\Factory\Filter;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Logic\Common\BenchmarkField\Provider\BenchmarkFieldsProvider;
use AppBundle\Logic\Common\BenchmarkField\Initializer\BenchmarkFieldsInitializer;

class ProductFilterFactory {
	
	/**
	 * 
	 * @var BenchmarkFieldsProvider
	 */
	protected $benchmarkFieldsProvider;
	
	/**
	 * 
	 * @var BenchmarkFieldsInitializer
	 */
	protected $showFieldsInitializer;
	
	/**
	 *
	 * @var BenchmarkFieldsInitializer
	 */
	protected $filterFieldsInitializer;
	
	public function __construct(BenchmarkFieldsProvider $benchmarkFieldsProvider, 
			BenchmarkFieldsInitializer $showFieldsInitializer, 
			BenchmarkFieldsInitializer $filterFieldsInitializer) {
		$this->benchmarkFieldsProvider = $benchmarkFieldsProvider;
		$this->showFieldsInitializer = $showFieldsInitializer;
		$this->filterFieldsInitializer = $filterFieldsInitializer;
	}
	
	public function create(Request $request, array $params) {
		$contextParams = $params['contextParams'];
		
// 		$em = $this->getDoctrine()->getManager();
// 		$benchmarkFieldMetadataRepository = new BenchmarkFieldMetadataRepository($em,
// 				$em->getClassMetadata(BenchmarkField::class));
		
// 		$translator = $this->get('translator');
		
// 		$benchmarkFieldsProvider = new BenchmarkFieldsProvider($benchmarkFieldMetadataRepository,
// 				$translator);
		
// 		$benchmarkFieldDataBaseUtils = new BenchmarkFieldDataBaseUtils();
// 		$benchmarkFieldFactory = new SimpleBenchmarkFieldFactory($benchmarkFieldDataBaseUtils);
// 		$benchmarkFieldsInitializer = new BenchmarkFieldsInitializerImpl($benchmarkFieldFactory);
		
		$item = new ProductFilter($this->benchmarkFieldsProvider, $this->benchmarkFieldsInitializer,
				$this->benchmarkFieldsInitializer);
		$item->initContextParams($contextParams);
		$item->initRequestValues($request);
		
		return $item;
	}
}