<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\Editor\Transformer\ArticleToNumberTransformer;
use AppBundle\Repository\Admin\Main\ArticleRepository;
use AppBundle\Form\Editor\Transformer\CategoryToNumberTransformer;

class ArticleCategoryAssignmentEditorType extends BaseEntityEditorType
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
		parent::addMainFields($builder, $options);
	
		/** @var ArticleRepository $articleRepository */
		$articleRepository = $this->em->getRepository(Article::class);
		$articles = $articleRepository->findFilterItems();
		
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->em->getRepository(Category::class);
		$categories = $categoryRepository->findFilterItems();
	
		$builder
		->add('article', ChoiceType::class, array(
				'choices' 		=> $articles,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('category', ChoiceType::class, array(
				'choices'		=> $categories,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('article')->addModelTransformer(new ArticleToNumberTransformer($this->em));
		$builder->get('category')->addModelTransformer(new CategoryToNumberTransformer($this->em));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return ArticleCategoryAssignment::class;
	}
}