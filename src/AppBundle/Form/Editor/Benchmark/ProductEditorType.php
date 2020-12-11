<?php

namespace AppBundle\Form\Editor\Benchmark;

use AppBundle\Entity\Main\Brand;
use AppBundle\Entity\Main\Product;
use AppBundle\Filter\Common\Other\ProductFilter;
use AppBundle\Form\Editor\Admin\Base\ImageEditorType;
use AppBundle\Form\FormBuilder\BenchmarkEditorFieldBuilder;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class ProductEditorType extends ImageEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $brandToNumberTransformer;

	/**
	 *
	 * @var BenchmarkEditorFieldBuilder
	 */
	protected $benchmarkEditorFieldBuilder;

	public function __construct(EntityToNumberTransformer $brandToNumberTransformer, 
			BenchmarkEditorFieldBuilder $benchmarkEditorFieldBuilder) {
		$this->brandToNumberTransformer = $brandToNumberTransformer;
		$this->benchmarkEditorFieldBuilder = $benchmarkEditorFieldBuilder;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.name');
		
		$this->addNumberField($builder, 'price', 'label.product.price', false);
		
		$this->addTrueEntityChoiceField($builder, $options, $this->brandToNumberTransformer, 'brand');
		
// 		$this->addFilterFields($builder, $options);
	}

	protected function addFilterFields(FormBuilderInterface $builder, array $options) {
		
		/** @var ProductFilter $filter */
		$filter = $options['filter'];
		
		if ($filter) {
			foreach ($filter->getEditorFields() as $field) {
				$this->benchmarkEditorFieldBuilder->add($builder, $field);
			}
		}
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('brand')] = [];
		$options['filter'] = null;
		
		return $options;
	}

	protected function getEntityType() {
		return Product::class;
	}
}