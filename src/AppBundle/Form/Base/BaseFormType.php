<?php

namespace AppBundle\Form\Base;

use AppBundle\Utils\ClassUtils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

abstract class BaseFormType extends AbstractType
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
	 * Otherwise use the {@link BaseFormType::addMoreFields} method.
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
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
			->add('search', SubmitType::class)
			->add('clear', SubmitType::class)
		;
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
		return 'app_' . ClassUtils::getClassName($this->getEntityType());
	}
	
	/**
	 * Get entity type (e.g <strong>Product::class</strong>)
	 *
	 * @return mixed
	 */
	protected abstract function getEntityType();
}