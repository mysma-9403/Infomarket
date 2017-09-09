<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Entity\Main\Category;
use AppBundle\Form\Editor\Admin\Base\BaseEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkFieldEditorType extends BaseEditorType {

	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $categoryToNumberTransformer;

	public function __construct(EntityToNumberTransformer $categoryToNumberTransformer) {
		$this->categoryToNumberTransformer = $categoryToNumberTransformer;
	}

	protected function addFields(FormBuilderInterface $builder, array $options) {
		parent::addFields($builder, $options);
		
		$this->addIntegerField($builder, 'valueNumber', 'label.benchmarkField.valueNumber');
		$this->addIntegerField($builder, 'fieldNumber', 'label.benchmarkField.fieldNumber', false);
		$this->addIntegerField($builder, 'filterNumber', 'label.benchmarkField.filterNumber', false);
		
		$this->addTextField($builder, 'fieldName', 'label.benchmarkField.fieldName', false);
		$this->addTextField($builder, 'filterName', 'label.benchmarkField.filterName', false);
		
		$this->addCheckboxField($builder, 'showField', 'label.benchmarkField.showField');
		$this->addCheckboxField($builder, 'showFilter', 'label.benchmarkField.showFilter');
		
		$this->addCheckboxField($builder, 'featuredField', 'label.benchmarkField.featuredField');
		$this->addCheckboxField($builder, 'featuredFilter', 'label.benchmarkField.featuredFilter');
		
		$this->addIntegerField($builder, 'decimalPlaces', 'label.benchmarkField.decimalPlaces', false);
		
		$this->addNumberField($builder, 'noteWeight', 'label.benchmarkField.noteWeight', false);
		$this->addNumberField($builder, 'compareWeight', 'label.benchmarkField.compareWeight', false);
		
		$this->addNumberChoiceField($builder, $options, 'fieldType');
		$this->addNumberChoiceField($builder, $options, 'noteType');
		$this->addNumberChoiceField($builder, $options, 'betterThanType');
		
		$this->addTrueEntityChoiceField($builder, $options, $this->categoryToNumberTransformer, 'category');
	}

	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('category')] = [];
		$options[self::getChoicesName('fieldType')] = [];
		$options[self::getChoicesName('noteType')] = [];
		$options[self::getChoicesName('betterThanType')] = [];
		
		return $options;
	}

	protected function getEntityType() {
		return BenchmarkField::class;
	}
}