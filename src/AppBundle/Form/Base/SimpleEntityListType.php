<?php

namespace AppBundle\Form\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

abstract class SimpleEntityListType extends AbstractType
{
	/**
	 * {@inheritdoc}
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$this->addMainFields($builder, $options);
		$this->addMoreFields($builder, $options);
		$this->addActions($builder, $options);
	}
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('entries', EntityType::class, array(
					'class'			=> $this->getEntityType(),
					'choice_label' 	=> 'name',
					'choices'		=> $options['choices'],
					'expanded'      => true,
					'multiple'      => true
			));
	}
	
	/**
	 * Get entity type (e.g. AppBundle:Branch)
	 *
	 * @return string
	 */
	protected abstract function getEntityType();
	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
			->add('new', SubmitType::class)
			->add('selectAll', SubmitType::class)
			->add('selectNone', SubmitType::class)
			->add('publishSelected', SubmitType::class)
			->add('unpublishSelected', SubmitType::class)
			->add('deleteSelected', SubmitType::class);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => $this->getEntityListClass(),
				'choices' => array(),
		));
	}
	
	/**
	 * Get entity class (e.g <string>BranchList::class</strong>)
	 *
	 * @return string
	 */
	protected abstract function getEntityListClass();
	
	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'app_' . $this->getEntityListName();
	}
	
	/**
	 * Get entity name (e.g <strong>branch_list</strong>)
	 *
	 * @return string
	 */
	protected abstract function getEntityListName();
}