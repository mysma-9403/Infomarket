<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockArticleAssignment;
use AppBundle\Entity\Article;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\Editor\Transformer\NewsletterBlockToNumberTransformer;
use AppBundle\Repository\Admin\Main\NewsletterBlockRepository;
use AppBundle\Form\Editor\Transformer\ArticleToNumberTransformer;

class NewsletterBlockArticleAssignmentEditorType extends BaseEntityEditorType
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
	
		/** @var NewsletterBlockRepository $newsletterBlockRepository */
		$newsletterBlockRepository = $this->em->getRepository(NewsletterBlock::class);
		$newsletterBlocks = $newsletterBlockRepository->findFilterItems();
		
		/** @var ArticleRepository $articleRepository */
		$articleRepository = $this->em->getRepository(Article::class);
		$articles = $articleRepository->findFilterItems();
	
		$builder
		->add('newsletterBlock', ChoiceType::class, array(
				'choices' 		=> $newsletterBlocks,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('article', ChoiceType::class, array(
				'choices'		=> $articles,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('newsletterBlock')->addModelTransformer(new NewsletterBlockToNumberTransformer($this->em));
		$builder->get('article')->addModelTransformer(new ArticleToNumberTransformer($this->em));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockArticleAssignment::class;
	}
}