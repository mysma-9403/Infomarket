<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Base\ImageEntityType;

class CategoryType extends ImageEntityType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('parent', EntityType::class, array(
					'class'			=> $this->getEntityType(),
					'choice_label' 	=> 'name',
					'required' => false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose parent'
			))
			->add('content', null, array(
					'attr' => array('rows' => 20),
					'required' => false
			))
			->add('featured', null, array(
					'required' => true
			))
			;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => $this->getEntityClass(),
				'choices' => array(),
		));
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityClass() {
		return Category::class;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityName() {
		return 'category';
	}
	
	protected function getEntityType() {
		return 'AppBundle:Category';
	}
}