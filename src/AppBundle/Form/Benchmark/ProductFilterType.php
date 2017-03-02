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
use AppBundle\Utils\ClassUtils;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Entity\Product;

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
		$fields = $options['fields'];
		
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
				'attr' => ['placeholder' => 'label.benchmark.minPrice'],
				'required' => false
		))
		->add('maxPrice', NumberType::class, array(
				'attr' => ['placeholder' => 'label.benchmark.maxPrice'],
				'required' => false
		))
		;
		
		$productRepository = new ProductRepository($this->em, $this->em->getClassMetadata(Product::class));
		
		foreach ($fields as $field) {
			switch($field['filterType']) {
				case BenchmarkField::SINGLE_ENUM_FILTER_TYPE:
				case BenchmarkField::MULTI_ENUM_FILTER_TYPE:
					$choices = $productRepository->findFilterItemsByValue($category, BenchmarkField::getValueTypeDBName($field['valueType']) . $field['valueNumber']);
					$builder->add(ClassUtils::getCleanName($field['filterName']), ChoiceType::class, array(
						'choices'		=> $choices,
						'choice_label' => function ($value, $key, $index) { return $value; },
						'choice_translation_domain' => false,
						'required'		=> false,
						'expanded'      => false,
						'multiple'      => true
					));
					break;
				default:
					$builder->add(ClassUtils::getCleanName($field['filterName']), null, array(
						'attr' => ['placeholder' => $field['filterName']],
						'required' => false
					));
					break;
			}
		}
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['category'] = null;
		$options['fields'] = array();
	
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