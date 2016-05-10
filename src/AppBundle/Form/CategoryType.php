<?php

namespace AppBundle\Form;

use AppBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Repository\CategoryRepository;

class CategoryType extends ImageEntityType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('subname', null, array(
					'required' => false
			))
			->add('icon', null, array(
					'required' => false
			))
			->add('parent', EntityType::class, array(
					'class'			=> $this->getEntityType(),
					'query_builder' => function (CategoryRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.treePath', 'ASC');
					},
					'choice_label' 	=> 'name',
					'required' => false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose parent'
			))
			->add('published', null, array(
					'required' => false
			))
			->add('preleaf', null, array(
					'required' => false
			))
			->add('featured', null, array(
					'required' => false
			))
			->add('content', null, array(
					'attr' => array(
							'class' => 'tinymce',
							'data-theme' => 'bbcode',
							'rows' => 20),
					'required' => false
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