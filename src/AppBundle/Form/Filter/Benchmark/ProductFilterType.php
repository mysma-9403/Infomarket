<?php

namespace AppBundle\Form\Filter\Benchmark;

use AppBundle\Entity\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\FormBuilder\BenchmarkFilterFieldBuilder;

class ProductFilterType extends FilterType {
	
	/**
	 *
	 * @var BenchmarkFilterFieldBuilder
	 */
	protected $benchmarkFilterFieldBuilder;
	
	
	
	public function __construct(BenchmarkFilterFieldBuilder $benchmarkFilterFieldBuilder) {
		$this->benchmarkFilterFieldBuilder = $benchmarkFilterFieldBuilder;
	}
	
	
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('name', TextType::class, array(
				'attr' => ['placeholder' => 'label.benchmark.product.name'],
				'required' => false
		));
		$builder->add('minPrice', NumberType::class, array(
				'attr' => ['placeholder' => 'label.benchmark.product.minPrice'],
				'required' => false
		));
		$builder->add('maxPrice', NumberType::class, array(
				'attr' => ['placeholder' => 'label.benchmark.product.maxPrice'],
				'required' => false
		))
		;
		
		$this->addEntityChoiceFilterField($builder, $options, 'brands');
		$this->addEntityChoiceFilterField($builder, $options, 'categories');
		
		$this->addFilterFields($builder, $options);
	}
	
	protected function addFilterFields(FormBuilderInterface $builder, array $options) {
		/** @var ProductFilter $filter */
		$filter = $options['filter'];
	
		if($filter) {
			foreach ($filter->getFilterFields() as $field) {
				$this->benchmarkFilterFieldBuilder->add($builder, $field);
			}
		}
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
	
		$builder->add('saveQuery', SubmitType::class);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('brands')] = [];
		$options[self::getChoicesName('categories')] = [];
		
		$options[self::getChoicesName('boolean')] = [];
		
		$options['filter'] = null;
		$options['choices'] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return ProductFilter::class;
	}
}