<?php

namespace AppBundle\Form;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleTagAssignment;
use AppBundle\Entity\Tag;
use AppBundle\Form\Base\BaseFormType;
use AppBundle\Form\Base\ImageEntityType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\TagRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleTagAssignmentType extends BaseFormType
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
			->add('tag', EntityType::class, array(
					'class'			=> Tag::class,
					'query_builder' => function (TagRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'displayName',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.tag'
			))
			->add('newTagName', TextType::class, array(
					'required' => false
			))
		;
	}
	
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleTagAssignment::class;
	}
}