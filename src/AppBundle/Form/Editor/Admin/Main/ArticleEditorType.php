<?php

namespace AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Article;
use AppBundle\Form\Editor\Admin\Base\ImageEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleEditorType extends ImageEntityEditorType
{
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $articleToNumberTransformer;
	
	/**
	 *
	 * @var EntityToNumberTransformer
	 */
	protected $userToNumberTransformer;
	
	public function __construct(EntityToNumberTransformer $articleToNumberTransformer, EntityToNumberTransformer $userToNumberTransformer) {
		$this->articleToNumberTransformer = $articleToNumberTransformer;
		$this->userToNumberTransformer = $userToNumberTransformer;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\SimpleEntityType::addMoreFields()
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('subname', TextType::class, array(
				'required' => false
		))
		->add('archived', CheckboxType::class, array(
				'required' => false
		))
		->add('featured', CheckboxType::class, array(
				'required' => false
		))
		->add('page', IntegerType::class, array(
				'required' => false
		))
		->add('orderNumber', IntegerType::class, array(
				'required' => false
		))
		
		->add('intro', CKEditorType::class, array(
				'config' => array('uiColor' => '#ffffff'),
				'required' => false
		))
		->add('content', CKEditorType::class, array(
				'config' => array('uiColor' => '#ffffff'),
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
		;
		
		$this->addNumberChoiceEditorField($builder, $options, 'layout');
		$this->addNumberChoiceEditorField($builder, $options, 'imageSize');
		
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->articleToNumberTransformer, 'parent', false);
		$this->addTrueEntityChoiceEditorField($builder, $options, $this->userToNumberTransformer, 'author', false);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('parent')] = [];
		$options[self::getChoicesName('author')] = [];
		
		$options[self::getChoicesName('layout')] = [];
		$options[self::getChoicesName('imageSize')] = [];
		
		return $options;
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