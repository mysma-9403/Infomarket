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
				'label.article.layout.default.left'			=> Article::DEFAULT_LEFT_LAYOUT,
				'label.article.layout.default.right'		=> Article::DEFAULT_RIGHT_LAYOUT,
				'label.article.layout.default.alternate'	=> Article::DEFAULT_ALTERNATE_LAYOUT,
				
				'label.article.layout.narrow.left' 			=> Article::NARROW_LEFT_LAYOUT,
				'label.article.layout.narrow.right' 		=> Article::NARROW_RIGHT_LAYOUT,
				'label.article.layout.narrow.alternate' 	=> Article::NARROW_ALTERNATE_LAYOUT,
				
				'label.article.layout.wide.normalImage' 	=> Article::WIDE_LAYOUT,
				'label.article.layout.wide.smallImage' 		=> Article::WIDE_SMALL_IMAGE_LAYOUT,
				
				'label.article.layout.column.2' 			=> Article::COLUMN_2_LAYOUT,
				'label.article.layout.column.3' 			=> Article::COLUMN_3_LAYOUT,
				'label.article.layout.column.4' 			=> Article::COLUMN_4_LAYOUT,
				
				'label.article.layout.grid.2' 				=> Article::GRID_2_LAYOUT,
				'label.article.layout.grid.3' 				=> Article::GRID_3_LAYOUT,
				'label.article.layout.grid.4' 				=> Article::GRID_4_LAYOUT,
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
					'query_builder' => function (ArticleRepository $repository) {
						return $repository->createQueryBuilder('e')
						->orderBy('e.published DESC, e.name', 'ASC');
					},
					'choice_label' 	=> 'name',
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.article.parent'
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
			->add('displayPaginated', null, array(
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
			->add('author', EntityType::class, array(
					'class'			=> User::class,
					'query_builder' => function (UserRepository $repository) {
					return $repository->createQueryBuilder('e')
					->orderBy('e.surname ASC, e.forename', 'ASC');
					},
					'choice_label' 	=> 'displayname',
					'required' 		=> true,
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