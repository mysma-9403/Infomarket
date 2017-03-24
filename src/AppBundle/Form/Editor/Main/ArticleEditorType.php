<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Article;
use AppBundle\Entity\User;
use AppBundle\Form\Editor\Base\FeaturedEntityEditorType;
use AppBundle\Form\Editor\Transformer\ArticleToNumberTransformer;
use AppBundle\Form\Editor\Transformer\UserToNumberTransformer;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleEditorType extends FeaturedEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		/** @var ArticleRepository $articleRepository */
		$articleRepository = $this->em->getRepository(Article::class);
		$articles = $articleRepository->findFilterItems();
		
		/** @var UserRepository $userRepository */
		$userRepository = $this->em->getRepository(User::class);
		$users = $userRepository->findFilterItems();
		
		$layoutChoices = array(
				Article::getLayoutName(Article::LEFT_LAYOUT) => Article::LEFT_LAYOUT,
				Article::getLayoutName(Article::MID_LAYOUT) => Article::MID_LAYOUT,
				Article::getLayoutName(Article::RIGHT_LAYOUT) => Article::RIGHT_LAYOUT,
				Article::getLayoutName(Article::BOTTOM_LAYOUT) => Article::BOTTOM_LAYOUT
		);
		
		$imageSizeChoices = array(
				Article::getImageSizeName(Article::SMALL_IMAGE) => Article::SMALL_IMAGE,
				Article::getImageSizeName(Article::MEDIUM_IMAGE) => Article::MEDIUM_IMAGE,
				Article::getImageSizeName(Article::LARGE_IMAGE) => Article::LARGE_IMAGE
		);
		
		$builder
		->add('archived', null, array(
				'required' => false
		))
		->add('subname', TextType::class, array(
				'required' => false
		))
		
		->add('parent', ChoiceType::class, array(
			'choices' 		=> $articles,
			'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
			'choice_translation_domain' => false,
			'required'		=> false,
			'expanded'      => false,
			'multiple'      => false,
			'placeholder' 	=> 'label.placeholder.none'
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
		->add('author', ChoiceType::class, array(
				'choices' 		=> $users,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => false,
				'placeholder' 	=> 'label.placeholder.none'
		))
		;
		
		$builder->get('parent')->addModelTransformer(new ArticleToNumberTransformer($this->em));
		$builder->get('author')->addModelTransformer(new UserToNumberTransformer($this->em));
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