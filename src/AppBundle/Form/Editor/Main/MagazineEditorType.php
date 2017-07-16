<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use AppBundle\Form\Transformer\EntityToNumberTransformer;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineEditorType extends ImageEntityEditorType
{
	/**
	 * 
	 * @var EntityToNumberTransformer
	 */
	protected $magazineToNumberTransformer;
	
	public function __construct(EntityToNumberTransformer $magazineToNumberTransformer) {
		$this->magazineToNumberTransformer = $magazineToNumberTransformer;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$builder
		->add('orderNumber', IntegerType::class, array(
				'required' => true
		))
		->add('magazineFile', ElFinderType::class, array(
				'instance'=>'magazine',
				'required' => true
		))
		->add('main', CheckboxType::class, array(
				'required' => false
		))
		->add('featured', CheckboxType::class, array(
				'required' => false
		))
		->add('content', CKEditorType::class, array(
				'config' => array(
						'uiColor' => '#ffffff'),
				'required' => false
		))
		->add('date', DateTimeType::class, array(
				'widget' => 'single_text',
				'format' => 'MM/yyyy',
				'required' => false,
				'attr' => [
						'class' => 'form-control input-inline datetimepicker',
						'data-provide' => 'datetimepicker',
						'data-date-format' => 'MM/YYYY',
						'placeholder' => 'label.magazine.date'
				]
		))
		;
		
		$this->addChoiceEntityEditorField($builder, $options, $this->magazineToNumberTransformer, 'parent', false);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options[self::getChoicesName('parent')] = [];
		
		return $options;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Magazine::class;
	}
}