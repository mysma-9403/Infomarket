<?php

namespace AppBundle\Form\Benchmark;

use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Brand;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Benchmark\ProductFilter;
use AppBundle\Form\Base\FilterType;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use AppBundle\Repository\Benchmark\BrandRepository;
use AppBundle\Repository\Benchmark\CategoryRepository;
use AppBundle\Repository\Benchmark\ProductRepository;
use AppBundle\Utils\StringUtils;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
		
		$user = $options['user'];
		$category = $options['category'];
		$fields = $options['fields'];
		
		$categoryRepository = new CategoryRepository($this->em, $this->em->getClassMetadata(Category::class));
		$categories = $categoryRepository->findFilterItemsByUserAndCategory($user, $category);
		
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
		->add('name', TextType::class, array(
				'attr' => ['placeholder' => 'label.benchmark.product.name'],
				'required' => false
		));
		$builder->add('minPrice', NumberType::class, array(
				'attr' => ['placeholder' => 'label.benchmark.product.minPrice'],
				'required' => false
		));
		$builder->add('maxPrice', NumberType::class, array(
				'attr' => ['placeholder' => 'label.benchmark.product.maxPrice'],
				'required' => false
		))
		;
		
		$booleanChoices = array(
				'label.benchmark.all'		=> Filter::ALL_VALUES,
				'label.benchmark.true' 		=> Filter::TRUE_VALUES,
				'label.benchmark.false' 	=> Filter::FALSE_VALUES
		);
		
		$productRepository = new ProductRepository($this->em, $this->em->getClassMetadata(Product::class));
		
		foreach ($fields as $field) {
			switch($field['filterType']) {
				case BenchmarkField::DECIMAL_FILTER_TYPE:
					$builder->add(StringUtils::getCleanName($field['filterName']) . '_min', NumberType::class, array(
							'attr' => ['placeholder' => $field['filterName'] . ' (min)'],
							'required' => false
					));
					$builder->add(StringUtils::getCleanName($field['filterName']) . '_max', NumberType::class, array(
							'attr' => ['placeholder' => $field['filterName'] . ' (max)'],
							'required' => false
					));
					break;
				case BenchmarkField::INTEGER_FILTER_TYPE:
					$builder->add(StringUtils::getCleanName($field['filterName']) . '_min', IntegerType::class, array(
						'attr' => ['placeholder' => $field['filterName'] . ' (min)'],
						'required' => false
					));
					$builder->add(StringUtils::getCleanName($field['filterName']) . '_max', IntegerType::class, array(
						'attr' => ['placeholder' => $field['filterName'] . ' (max)'],
						'required' => false
					));
					break;
				case BenchmarkField::BOOLEAN_FILTER_TYPE:
					$builder->add(StringUtils::getCleanName($field['filterName']), ChoiceType::class, array(
							'choices'		=> $booleanChoices,
							'required'		=> true,
							'expanded'      => false,
							'multiple'      => false
					));
					break;
				case BenchmarkField::SINGLE_ENUM_FILTER_TYPE:
				case BenchmarkField::MULTI_ENUM_FILTER_TYPE:
					$choices = $productRepository->findFilterItemsByValue($category, BenchmarkField::getValueTypeDBName($field['valueType']) . $field['valueNumber']);
					$builder->add(StringUtils::getCleanName($field['filterName']), ChoiceType::class, array(
						'choices'		=> $choices,
						'choice_label' => function ($value, $key, $index) { return $value; },
						'choice_translation_domain' => false,
						'required'		=> false,
						'expanded'      => false,
						'multiple'      => true
					));
					break;
				default:
					$builder->add(StringUtils::getCleanName($field['filterName']), null, array(
						'attr' => ['placeholder' => $field['filterName']],
						'required' => false
					));
					break;
			}
		}
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		parent::addActions($builder, $options);
		
		$builder
		->add('saveQuery', SubmitType::class)
		->add('saveResults', SubmitType::class)
		;
	}
	
	protected function getDefaultOptions() {
		$options = parent::getDefaultOptions();
		
		$options['user'] = null;
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