<?php

namespace AppBundle\Form\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

abstract class SimpleEntityType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$this->addMainFields($builder, $options);
		$this->addMoreFields($builder, $options);
		$this->addActions($builder, $options);
	}
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('name', TextType::class, array(
					'attr' => array('autofocus' => true)
			))
			->add('file', FileType::class, array(
					'required' => false
			))
			;
	}
	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
			->add('saveAndNew', SubmitType::class)
			->add('saveAndCopy', SubmitType::class)
			->add('saveAndQuit', SubmitType::class);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => $this->getEntityClass()
		));
	}
	
	/**
	 * Get entity class (e.g <strong>Branch::class</strong>)
	 *
	 * @return string
	 */
	protected abstract function getEntityClass();
	
	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'app_' . $this->getEntityName();
	}
	
	/**
	 * Get entity name (e.g <strong>branch</strong>)
	 *
	 * @return string
	 */
	protected abstract function getEntityName();
}