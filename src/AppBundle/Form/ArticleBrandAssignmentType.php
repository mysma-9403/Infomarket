<?php

namespace AppBundle\Form;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleBrandAssignment;
use AppBundle\Entity\Brand;
use AppBundle\Form\Base\BaseFormType;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\BrandRepository;

class ArticleBrandAssignmentType extends BaseFormType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('article', EntityType::class, array(
					'class'			=> Article::class,
					'query_builder' => function (ArticleRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.article'
			))
			->add('brand', EntityType::class, array(
					'class'			=> Brand::class,
					'query_builder' => function (BrandRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> true,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.brand'
			))
		;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleBrandAssignment::class;
	}
}