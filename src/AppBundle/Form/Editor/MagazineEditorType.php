<?php

namespace AppBundle\Form\Editor;

use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Repository\MagazineRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class MagazineEditorType extends ImageEntityEditorType
{
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		$builder
			->add('orderNumber', null, array(
					'required' => true
			))
			->add('magazineFile', ElFinderType::class, array(
					'instance'=>'magazine',
					'required' => true
			))
			->add('featured', null, array(
					'required' => false
			))
			->add('main', null, array(
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
			
			->add('parent', EntityType::class, array(
					'class'			=> $this->getEntityType(),
					'query_builder' => function (MagazineRepository $repository) {
					return $repository->createQueryBuilder('e')
					->where('e.main = true AND e.parent IS NULL')
					->orderBy('e.name', 'ASC');
					},
					'required' 		=> false,
					'expanded'      => false,
					'multiple'      => false,
					'placeholder'	=> 'label.choose.magazine.parent'
			))
			;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Magazine::class;
	}
}