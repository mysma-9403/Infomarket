<?php

namespace AppBundle\Form;

use AppBundle\Entity\Article;
use AppBundle\Form\Base\SimpleEntityType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\ArticleCategory;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ArticleType extends ImageEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$layoutChoices = array(
				'Default (left)'		=> Article::DEFAULT_LEFT_LAYOUT,
				'Default (right)'		=> Article::DEFAULT_RIGHT_LAYOUT,
				'Default (alternate)'	=> Article::DEFAULT_ALTERNATE_LAYOUT,
				
				'Narrow (left)' 		=> Article::NARROW_LEFT_LAYOUT,
				'Narrow (right)' 		=> Article::NARROW_RIGHT_LAYOUT,
				'Narrow (alternate)' 	=> Article::NARROW_ALTERNATE_LAYOUT,
				
				'Wide' 					=> Article::WIDE_LAYOUT,
				'Wide (small image)' 	=> Article::WIDE_SMALL_IMAGE_LAYOUT,
				
				'Column (2)' 			=> Article::COLUMN_2_LAYOUT,
				'Column (3)' 			=> Article::COLUMN_3_LAYOUT,
				'Column (4)' 			=> Article::COLUMN_4_LAYOUT,
				
				'Grid (2)' 				=> Article::GRID_2_LAYOUT,
				'Grid (3)' 				=> Article::GRID_3_LAYOUT,
				'Grid (4)' 				=> Article::GRID_4_LAYOUT,
		);
		
		$builder
			->add('featured', null, array(
					'required' => false
			))
			->add('subname', TextType::class, array(
					'required' => false
			))
			->add('parent', EntityType::class, array(
					'class'			=> $this->getEntityType(),
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose parent'
			))
			->add('articleCategory', EntityType::class, array(
					'class'			=> ArticleCategory::class,
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'Choose category'
			))
			->add('intro', null, array(
					'attr' => array('rows' => 5),
					'required' => false
			))
			->add('content', null, array(
					'attr' => array('rows' => 20),
					'required' => false
			))
			->add('layout', ChoiceType::class, array(
					'choices'		=> $layoutChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('orderNumber', NumberType::class, array(
					'required' => false
			))
			->add('displaySided', null, array(
					'required' => false
			))
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return Article::class;
	}
}