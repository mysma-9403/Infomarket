<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Form\Base\FilterType;
use AppBundle\Form\FormBuilder\BenchmarkFilterFieldBuilder;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductFilterType extends FilterType {

	/**
	 *
	 * @var BenchmarkFilterFieldBuilder
	 */
	protected $benchmarkFilterFieldBuilder;

	public function __construct(BenchmarkFilterFieldBuilder $benchmarkFilterFieldBuilder) {
		$this->benchmarkFilterFieldBuilder = $benchmarkFilterFieldBuilder;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterTextField($builder, 'name', 'label.benchmark.product.name');
		
		$this->addFilterNumberField($builder, 'minPrice', 'label.benchmark.product.minPrice');
		$this->addFilterNumberField($builder, 'maxPrice', 'label.benchmark.product.maxPrice');
		
		$this->addFilterEntityChoiceField($builder, $options, 'brands');
		$this->addFilterEntityChoiceField($builder, $options, 'categories');
		
		$this->addFilterFields($builder, $options);
	}

	protected function addFilterFields(FormBuilderInterface $builder, array $options) {
		
		/** @var ProductFilter $filter */
		$filter = $options['filter'];
		
		if ($filter) {
			foreach ($filter->getFilterFields() as $field) {
				$this->benchmarkFilterFieldBuilder->add($builder, $field, $options);
			}
		}
	}

	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder->add('saveQuery', SubmitType::class);
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('brands')] = [ ];
		$options[self::getChoicesName('categories')] = [ ];
		
		$options[self::getChoicesName('boolean')] = [ ];
		
		$options['filter'] = null;
		$options['choices'] = [ ];
		
		return $options;
	}

	protected function getEntityType() {
		return ProductFilter::class;
	}
}