<?php

namespace AppBundle\Form\Base;

use AppBundle\Utils\FormUtils;
use AppBundle\Utils\StringUtils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class BaseType extends AbstractType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \Symfony\Component\Form\AbstractType::buildForm()
	 */
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
	
	protected function addSingleChoiceField(FormBuilderInterface $builder, array $options, $transformer, $field, $required = true) {
		$builder->add($field, ChoiceType::class, array(
				'choices' 		=> $options[$field],
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); }, //TODO FormUtils --> DI
				'choice_translation_domain' => false,
				'required'		=> $required,
				'expanded'      => false,
				'multiple'      => false
		));
		$builder->get($field)->addModelTransformer($transformer);
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
		return 'app_' . StringUtils::getClassName($this->getEntityType());
	}
	
	/**
	 * Get entity type (e.g <strong>Product::class</strong>)
	 *
	 * @return mixed
	 */
	abstract protected function getEntityType();
}