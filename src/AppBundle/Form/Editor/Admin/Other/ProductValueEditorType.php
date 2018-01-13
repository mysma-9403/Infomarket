<?php

namespace AppBundle\Form\Editor\Admin\Other;

use AppBundle\Entity\Other\ProductValue;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\FormBuilder\BenchmarkEditorFieldBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class ProductValueEditorType extends BaseEditorType {

	/**
	 *
	 * @var BenchmarkEditorFieldBuilder
	 */
	protected $benchmarkEditorFieldBuilder;

	public function __construct(BenchmarkEditorFieldBuilder $benchmarkEditorFieldBuilder) {
		$this->benchmarkEditorFieldBuilder = $benchmarkEditorFieldBuilder;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addFilterFields($builder, $options);
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
		
		$options['filter'] = null;
		
		return $options;
	}

	protected function getEntityType() {
		return ProductValue::class;
	}
}