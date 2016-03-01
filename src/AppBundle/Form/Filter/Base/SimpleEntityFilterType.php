<?php

namespace AppBundle\Form\Filter\Base;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Entity\Filter\Base\SimpleEntityFilter;

class SimpleEntityFilterType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$this->addMainFields($builder, $options);
		$this->addMoreFields($builder, $options);
		$this->addActions($builder, $options);
	}
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		$publishChoices = array(
				'Published' 	=> 1,
				'Unpublished' 	=> 2
		);
		
		$builder
// 			->add('published', ChoiceType::class, array(
// 					'placeholder'	=> 'All',
// 					'choices'		=> $publishChoices,
// 					'expanded'      => false,
// 					'multiple'      => false,
// 					'required' 		=> false
// 			))
			->add('name', TextType::class, array(
					'attr' => array('autofocus' => true),
					'required' => false
			));
	}
	
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
			->add('search', SubmitType::class)
			->add('clear', SubmitType::class);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => $this->getEntityFilterClass()
		));
	}
	
	/**
	 * Get entity class (e.g <strong>SimpleEntityFilter::class</strong>)
	 *
	 * @return string
	 */
	protected function getEntityFilterClass() {
		return SimpleEntityFilter::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getName()
	{
		return 'app_' . $this->getEntityFilterName();
	}
	
	/**
	 * Get entity name (e.g <strong>simple_entity_filter</strong>)
	 *
	 * @return string
	 */
	protected function getEntityFilterName() {
		return 'simple_entity_filter';
	}
}