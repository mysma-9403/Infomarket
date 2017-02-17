<?php

namespace AppBundle\Form\Editor\Main;

use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Base\ImageEntityEditorType;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\Editor\Transformer\CategoryToNumberTransformer;

class CategoryEditorType extends ImageEntityEditorType
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
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->em->getRepository(Category::class);
		$categories = $categoryRepository->findFilterItems();
		
		$builder
		->add('subname', null, array(
				'required' => false
		))
		->add('orderNumber', null, array(
				'required' => true
		))
		->add('icon', null, array(
				'required' => false
		))
		->add('iconImage', ElFinderType::class, array(
				'instance'=>'icon',
				'required' => false
		))
		->add('featuredImage', ElFinderType::class, array(
				'instance'=>'featured',
				'required' => false
		))
		->add('parent', ChoiceType::class, array(
				'choices'		=> $categories,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('preleaf', null, array(
				'required' => false
		))
		->add('featured', null, array(
				'required' => false
		))
		->add('content', CKEditorType::class, array(
				'config' => array(
						'uiColor' => '#ffffff'),
				'required' => false
		))
		;
		
		$builder->get('parent')->addModelTransformer(new CategoryToNumberTransformer($this->em));
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return Category::class;
	}
}