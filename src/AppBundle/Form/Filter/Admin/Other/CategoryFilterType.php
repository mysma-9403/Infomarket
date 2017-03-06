<?php

namespace AppBundle\Form\Filter\Admin\Other;

use AppBundle\Entity\Category;
use AppBundle\Form\Base\BaseType;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Filter\Admin\Other\CategoryFilter;
use AppBundle\Repository\Admin\Main\CategoryRepository;

class CategoryFilterType extends BaseType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\BaseFormType::addMoreFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		$product = $options['product'];
		
		$categoryRepository = new CategoryRepository($this->em, $this->em->getClassMetadata(Category::class));
		$categories = $categoryRepository->findFilterItemsByProduct($product);
	
		$builder
		->add('category', ChoiceType::class, array(
				'choices'		=> $categories,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addActions()
	 */
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder->add('submit', SubmitType::class);
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
	
		$options['product'] = null;
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return CategoryFilter::class;
	}
}