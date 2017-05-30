<?php

namespace AppBundle\Form\Benchmark;

use AppBundle\Entity\Category;
use AppBundle\Filter\Benchmark\SubcategoryFilter;
use AppBundle\Form\Base\BaseType;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Repository\Benchmark\CategoryRepository;

class SubcategoryFilterType extends BaseType
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
		
		$subcategoryRepository = new CategoryRepository($this->em, $this->em->getClassMetadata(Category::class));
		$subcategories = $subcategoryRepository->findFilterItemsByUserAndCategory($user, $category);
	
		$builder
		->add('subcategory', ChoiceType::class, array(
				'choices'		=> $subcategories,
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
	
		$options['user'] = null;
		$options['category'] = null;
	
		return $options;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return SubcategoryFilter::class;
	}
}