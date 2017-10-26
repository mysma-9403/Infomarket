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
	protected $categoryTransformer;
	
	public function __construct(EntityToNumberTransformer $categoryTransformer) {
		$this->categoryTransformer = $categoryTransformer;
	}
	
	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addTextField($builder, 'name', 'label.benchmarkEnum.name');
		$this->addIntegerField($builder, 'value', 'label.benchmarkEnum.value');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options[self::getChoicesName('category')] = [];
	
		return $options;
	}
	
	protected function getEntityType() {
		return BenchmarkEnum::class;
	}
}