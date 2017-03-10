<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use AppBundle\Form\Editor\Transformer\MagazineToNumberTransformer;
use AppBundle\Repository\Admin\Main\ParentMagazineRepository;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;

class MagazineEditorType extends ImageEntityEditorType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function addMoreFields(FormBuilderInterface $builder, array $options) {
		
		$magazineRepository = new ParentMagazineRepository($this->em, $this->em->getClassMetadata(Magazine::class));
		$magazines = $magazineRepository->findFilterItems();
		
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
		
		->add('parent', ChoiceType::class, array(
				'choices' 		=> $magazines,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => false,
				'placeholder' 	=> 'label.placeholder.none'
		))
		;
		
		$builder->get('parent')->addModelTransformer(new MagazineToNumberTransformer($this->em));
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Magazine::class;
	}
}