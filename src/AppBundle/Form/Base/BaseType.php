<?php

namespace AppBundle\Form\Base;

use AppBundle\Utils\ClassUtils;
use AppBundle\Utils\FormUtils;
use AppBundle\Utils\ParamUtils;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class BaseType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$this->addFields($builder, $options);
		$this->addActions($builder, $options);
	}

	/**
	 * Add form fields.
	 *
	 * @param FormBuilderInterface $builder        	
	 * @param array $options        	
	 */
	protected function addFields(FormBuilderInterface $builder, array $options) {
	}

	/**
	 * Add form action (submit) buttons.
	 *
	 * @param FormBuilderInterface $builder        	
	 * @param array $options        	
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
	}
	
	// TODO move to FieldFactory
	protected function addFilterTextField(FormBuilderInterface $builder, $field, $placeholder) {
		$this->addTextField($builder, $field, $placeholder, false);
	}

	protected function addTextField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$builder->add($field, TextType::class, 
				array('attr' => ['placeholder' => $placeholder], 'required' => $required));
	}

	protected function addRawTextField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$builder->add($field, TextType::class, 
				array('attr' => ['placeholder' => $placeholder], 'required' => $required, 'trim' => false));
	}

	protected function addTextareaField(FormBuilderInterface $builder, $field, $placeholder, $required = true, 
			$rows = 10) {
		$builder->add($field, TextareaType::class, 
				array('attr' => array('placeholder' => $placeholder, 'rows' => $rows), 'required' => $required));
	}

	protected function addSearchField(FormBuilderInterface $builder, $field, $placeholder) {
		$builder->add($field, SearchType::class, 
				array('attr' => ['placeholder' => $placeholder], 'required' => false));
	}

	protected function addFilterNumberField(FormBuilderInterface $builder, $field, $placeholder) {
		$this->addNumberField($builder, $field, $placeholder, false);
	}

	protected function addNumberField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$builder->add($field, NumberType::class, 
				array('attr' => ['placeholder' => $placeholder], 'required' => $required));
	}

	protected function addFilterIntegerField(FormBuilderInterface $builder, $field, $placeholder) {
		$this->addIntegerField($builder, $field, $placeholder, false);
	}

	protected function addIntegerField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$builder->add($field, IntegerType::class, 
				array('attr' => ['placeholder' => $placeholder], 'required' => $required));
	}

	protected function addFileField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$builder->add($field, FileType::class, array('required' => $required));
	}

	protected function addCheckboxField(FormBuilderInterface $builder, $field, $placeholder) {
		$builder->add($field, CheckboxType::class, array('required' => false));
	}

	protected function addCKEditorField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$builder->add($field, CKEditorType::class, 
				array('config' => array('uiColor' => '#ffffff'), 'required' => $required));
	}

	protected function addIconImageField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$this->addELFinderField($builder, 'icon', $field, $placeholder, $required);
	}

	protected function addFeaturedImageField(FormBuilderInterface $builder, $field, $placeholder, 
			$required = true) {
		$this->addELFinderField($builder, 'featured', $field, $placeholder, $required);
	}

	protected function addTopProduktImageField(FormBuilderInterface $builder, $field, $placeholder, 
			$required = true) {
		$this->addELFinderField($builder, 'topProdukt', $field, $placeholder, $required);
	}

	protected function addMagazineFileField(FormBuilderInterface $builder, $field, $placeholder, 
			$required = true) {
		$this->addELFinderField($builder, 'magazine', $field, $placeholder, $required);
	}

	protected function addNewsletterUsersFileField(FormBuilderInterface $builder, $field, $placeholder, 
			$required = true) {
		$this->addELFinderField($builder, 'newsletter_users', $field, $placeholder, $required);
	}

	protected function addRatingsFileField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$this->addELFinderField($builder, 'ratings', $field, $placeholder, $required);
	}

	private function addELFinderField(FormBuilderInterface $builder, $type, $field, $placeholder, 
			$required = true) {
		$builder->add($field, ElFinderType::class, array('instance' => $type, 'required' => $required));
	}

	protected function addFilterDateTimeField(FormBuilderInterface $builder, $field, $placeholder) {
		$this->addDateTimeField($builder, $field, $placeholder, false);
	}

	protected function addDateTimeField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$this->addDateFormatField($builder, 'dd/MM/yyyy HH:mm', $field, $placeholder, $required);
	}

	protected function addFilterMonthField(FormBuilderInterface $builder, $field, $placeholder) {
		$this->addMonthField($builder, $field, $placeholder, false);
	}

	protected function addMonthField(FormBuilderInterface $builder, $field, $placeholder, $required = true) {
		$this->addDateFormatField($builder, 'MM/yyyy', $field, $placeholder, $required);
	}

	private function addDateFormatField(FormBuilderInterface $builder, $format, $field, $placeholder, 
			$required = true) {
		$builder->add($field, DateTimeType::class, 
				array('widget' => 'single_text', 'format' => $format, 'required' => $required, 
						'attr' => ['class' => 'form-control input-inline datetimepicker', 
								'data-provide' => 'datepicker', 'data-date-format' => 'DD/MM/YYYY HH:mm', 
								'placeholder' => $placeholder]));
	}

	protected function addNumberChoiceField(FormBuilderInterface $builder, array $options, $field, 
			$required = true, $multiple = false, $expanded = false) {
		$this->addChoiceField($builder, $options, $field, $required, $multiple, $expanded);
	}

	protected function addFilterNumberChoiceField(FormBuilderInterface $builder, array $options, $field, 
			$expanded = false) {
		$this->addChoiceField($builder, $options, $field, false, true, $expanded);
	}

	protected function addFilterBooleanChoiceField(FormBuilderInterface $builder, array $options, $field, 
			$expanded = false) {
		$this->addChoiceField($builder, $options, $field, true, false, $expanded);
	}

	private function addChoiceField(FormBuilderInterface $builder, array $options, $field, $required, $multiple, 
			$expanded) {
		$params = ['choices' => $options[self::getChoicesName($field)], 'required' => $required, 
				'multiple' => $multiple, 'expanded' => $expanded];
		if ($multiple && ! $expanded) {
			$params['attr'] = ['class' => 'multiple'];
		}
		$builder->add($field, ChoiceType::class, $params);
	}

	protected function addTrueEntityChoiceField(FormBuilderInterface $builder, array $options, $transformer, 
			$field, $required = true) {
		$this->addTransformerChoiceField($builder, $options, $transformer, $field, $required, false, false);
	}

	private function addTransformerChoiceField(FormBuilderInterface $builder, array $options, $transformer, 
			$field, $required, $multiple, $expanded) {
		$this->addEntityChoiceField($builder, $options, $field, $required, $multiple, $expanded);
		$builder->get($field)->addModelTransformer($transformer);
	}

	protected function addTempEntityChoiceField(FormBuilderInterface $builder, array $options, $field, 
			$required = true, $multiple = false, $expanded = false) {
		$this->addEntityChoiceField($builder, $options, $field, $required, $multiple, $expanded);
	}

	protected function addFilterEntityChoiceField(FormBuilderInterface $builder, array $options, $field, 
			$required = false, $multiple = true, $expanded = false) {
		$this->addEntityChoiceField($builder, $options, $field, $required, $multiple, $expanded);
	}

	private function addEntityChoiceField(FormBuilderInterface $builder, array $options, $field, $required, 
			$multiple, $expanded) {
		$params = ['choices' => $options[self::getChoicesName($field)], 
				'choice_label' => function ($value, $key, $index) {
					return FormUtils::getChoiceLabel($value, $key, $index);
				}, 'choice_translation_domain' => false, 'required' => $required, 'multiple' => $multiple, 
				'expanded' => $expanded];
		if ($multiple && ! $expanded) {
			$params['attr'] = ['class' => 'multiple'];
		}
		$builder->add($field, ChoiceType::class, $params);
	}

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