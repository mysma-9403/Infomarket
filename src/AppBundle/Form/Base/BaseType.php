<?php

namespace AppBundle\Form\Base;

use AppBundle\Utils\ClassUtils;
use AppBundle\Utils\FormUtils;
use AppBundle\Utils\ParamUtils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class BaseType extends AbstractType {
	
	
	
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$this->addMainFields($builder, $options);
		$this->addMoreFields($builder, $options);
		$this->addActions($builder, $options);
	}
	
	/**
	 * Add main form fields.
	 * Override only if you want to change main fields.
	 * Otherwise use the {@link EditorFormType::addMoreFields} method.
	 * 
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) { }
	
	/**
	 * Add additional form fields.
	 * 
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) { }
	
	/**
	 * Add form action fiels / submit buttons.
	 * 
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) { }
	
	
	
	protected function addDateTimeField(FormBuilderInterface $builder, $field, $label, $required = true) {
		$builder->add($field, DateTimeType::class, array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy HH:mm',
				'required' => $required,
				'attr' => [
						'class' => 'form-control input-inline datetimepicker',
						'data-provide' => 'datepicker',
						'data-date-format' => 'DD/MM/YYYY HH:mm',
						'placeholder' => $label
				]
		));
	}
	
	
	protected function addNumberChoiceEditorField(FormBuilderInterface $builder, array $options, $field, $required = true, $multiple = false, $expanded = false) {
		$this->addNumberChoiceField($builder, $options, $field, $required, $multiple, $expanded);
	}
	
	protected function addNumberChoiceFilterField(FormBuilderInterface $builder, array $options, $field, $expanded = false) {
		$this->addNumberChoiceField($builder, $options, $field, false, true, $expanded);
	}
	
	protected function addBooleanChoiceFilterField(FormBuilderInterface $builder, array $options, $field, $expanded = false) {
		$this->addNumberChoiceField($builder, $options, $field, true, false, $expanded);
	}
	
	private function addNumberChoiceField(FormBuilderInterface $builder, array $options, $field, $required, $multiple, $expanded) {
		$params = [
			'choices'		=> $options[self::getChoicesName($field)],
			'required'      => $required,
			'multiple'      => $multiple,
			'expanded'      => $expanded
		];
		if($multiple && !$expanded) {
			$params['attr'] = ['class' => 'multiple'];
		}
		$builder->add($field, ChoiceType::class, $params);
	}
	
	
	protected function addTrueEntityChoiceEditorField(FormBuilderInterface $builder, array $options, $transformer, $field, $required = true) {
		$this->addTransformerChoiceField($builder, $options, $transformer, $field, $required, false, false);
	}
	
	private function addTransformerChoiceField(FormBuilderInterface $builder, array $options, $transformer, $field, $required, $multiple, $expanded) {
		$this->addEntityChoiceField($builder, $options, $field, $required, $multiple, $expanded);
		$builder->get($field)->addModelTransformer($transformer);
	}
	
	protected function addTempEntityChoiceEditorField(FormBuilderInterface $builder, array $options, $field, $required = true, $multiple = false, $expanded = false) {
		$this->addEntityChoiceField($builder, $options, $field, $required, $multiple, $expanded);
	}
	
	protected function addEntityChoiceFilterField(FormBuilderInterface $builder, array $options, $field, $required = false, $multiple = true, $expanded = false) {
		$this->addEntityChoiceField($builder, $options, $field, $required, $multiple, $expanded);
	}
	
	private function addEntityChoiceField(FormBuilderInterface $builder, array $options, $field, $required, $multiple, $expanded) {
		$params = [
				'choices' 		=> $options[self::getChoicesName($field)],
				'choice_label' => function ($value, $key, $index) { return FormUtils::getChoiceLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> $required,
				'multiple'      => $multiple,
				'expanded'      => $expanded
		];
		if($multiple && !$expanded) {
			$params['attr'] = ['class' => 'multiple'];
		}
		$builder->add($field, ChoiceType::class, $params);
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::configureOptions()
	 */
	public function configureOptions(OptionsResolver $resolver) {
		$options = $this->getDefaultOptions();
		$resolver->setDefaults($options);
	}
	
	/**
	 * Get default options for OptionsResolver.
	 * 
	 * @return array
	 * 
	 * @see \Symfony\Component\OptionsResolver\OptionsResolver
	 */
	protected function getDefaultOptions() {
		$options = array();
		
		$options['data_class'] = $this->getEntityType();
		
		return $options;
	}
	
	public function getName() {
		return 'app_' . ClassUtils::getUnderscoreName($this->getEntityType());
	}
	
	public function getChoicesName($field) {
		return ParamUtils::getChoicesName($field);
	}
	
	/**
	 * Get entity type (e.g <strong>Product::class</strong>)
	 *
	 * @return mixed
	 */
	abstract protected function getEntityType();
}