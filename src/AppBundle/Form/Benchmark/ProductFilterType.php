<?php

namespace AppBundle\Form\Benchmark;

use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use AppBundle\Repository\Benchmark\BrandRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Form\Base\FilterType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ProductFilterType extends FilterType
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
		
		$category = $options['category'];
		
		$categoryRepository = new CategoryRepository($this->em, $this->em->getClassMetadata(Category::class));
		$categories = $categoryRepository->findFilterItemsByCategory($category);
		
		$brandRepository = new BrandRepository($this->em, $this->em->getClassMetadata(Brand::class));
		$brands = $brandRepository->findFilterItemsByCategory($category);
		
		$builder
		->add('brands', ChoiceType::class, array(
				'choices'		=> $brands,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('categories', ChoiceType::class, array(
				'choices'		=> $categories, 
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('minPrice', NumberType::class, array(
				'attr' => ['placeholder' => 'label.product.minPrice'],
				'required' => false
		))
		->add('maxPrice', NumberType::class, array(
				'attr' => ['placeholder' => 'label.product.maxPrice'],
				'required' => false
		))
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['category'] = null;
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return ProductFilter::class;
	}
}