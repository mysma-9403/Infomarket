<?php

namespace AppBundle\Form;

use AppBundle\Entity\Article;
use AppBundle\Form\Base\ImageEntityType;
use AppBundle\Form\Base\SimpleEntityType;
use AppBundle\Repository\ArticleRepository;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use AppBundle\Repository\UserRepository;
use AppBundle\Entity\User;

class ArticleType extends ImageEntityType
{
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$layoutChoices = array(
				'label.article.layout.left'			=> Article::LEFT_LAYOUT,
				'label.article.layout.mid'			=> Article::MID_LAYOUT,
				'label.article.layout.right'		=> Article::RIGHT_LAYOUT,
				'label.article.layout.bottom'		=> Article::BOTTOM_LAYOUT,
		);
		
		$imageSizeChoices = array(
				'label.article.imageSize.small'			=> Article::SMALL_IMAGE,
				'label.article.imageSize.medium'		=> Article::MEDIUM_IMAGE,
				'label.article.imageSize.large'			=> Article::LARGE_IMAGE,
		);
		
		$builder
			->add('featured', null, array(
					'required' => false
			))
			->add('archived', null, array(
					'required' => false
			))
			->add('subname', TextType::class, array(
					'required' => false
			))
			
			->add('parent', EntityType::class, array(
					'class'			=> $this->getEntityType(),
					'query_builder' => function (ArticleRepository $repository) {
						return $repository->createQueryBuilder('e')
						->where('e.parent IS NULL')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.article.parent'
			))
			
			->add('layout', ChoiceType::class, array(
					'choices'		=> $layoutChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('imageSize', ChoiceType::class, array(
					'choices'		=> $imageSizeChoices,
					'expanded'      => false,
					'multiple'      => false
			))
			->add('page', NumberType::class, array(
					'required' => false
			))
			->add('orderNumber', NumberType::class, array(
					'required' => false
			))
			
			->add('intro', CKEditorType::class, array(
					'config' => array(
							'uiColor' => '#ffffff'),
					'required' => false
			))
			->add('content', CKEditorType::class, array(
					'config' => array(
							'uiColor' => '#ffffff'),
					'required' => false
			))
			
			->add('date', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => true,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.article.date'
					]
			))
			->add('endDate', DateTimeType::class, array(
					'widget' => 'single_text',
					'format' => 'dd/MM/yyyy HH:mm',
					'required' => false,
					'attr' => [
							'class' => 'form-control input-inline datetimepicker',
							'data-provide' => 'datetimepicker',
							'data-date-format' => 'DD/MM/YYYY HH:mm',
							'placeholder' => 'label.article.endDate'
					]
			))
			->add('author', EntityType::class, array(
					'class'			=> User::class,
					'query_builder' => function (UserRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.surname ASC, e.forename', 'ASC');
					},
					'choice_label' 	=> 'displayname',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.user'
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