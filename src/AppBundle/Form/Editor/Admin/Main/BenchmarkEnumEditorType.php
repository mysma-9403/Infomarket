<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\BenchmarkEnum;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Transformer\EntityToNumberTransformer;

class BenchmarkEnumEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $benchmarkFieldTransformer;

	public function __construct(EntityToNumberTransformer $benchmarkFieldTransformer) {
		$this->benchmarkFieldTransformer = $benchmarkFieldTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.benchmarkEnum.name');
		$this->addIntegerField($builder, 'value', 'label.benchmarkEnum.value');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->benchmarkFieldTransformer, 'benchmarkField');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('benchmarkField')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return BenchmarkEnum::class;
	}
}