<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterBlock;
use AppBundle\Entity\NewsletterBlockMagazineAssignment;
use AppBundle\Entity\Magazine;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\Editor\Transformer\NewsletterBlockToNumberTransformer;
use AppBundle\Repository\Admin\Main\NewsletterBlockRepository;
use AppBundle\Form\Editor\Transformer\MagazineToNumberTransformer;

class NewsletterBlockMagazineAssignmentEditorType extends BaseEntityEditorType
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
		
		/** @var MagazineRepository $magazineRepository */
		$magazineRepository = $this->em->getRepository(Magazine::class);
		$magazines = $magazineRepository->findFilterItems();
	
		$builder
		->add('newsletterBlock', ChoiceType::class, array(
				'choices' 		=> $newsletterBlocks,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('magazine', ChoiceType::class, array(
				'choices'		=> $magazines,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('newsletterBlock')->addModelTransformer(new NewsletterBlockToNumberTransformer($this->em));
		$builder->get('magazine')->addModelTransformer(new MagazineToNumberTransformer($this->em));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterBlockMagazineAssignment::class;
	}
}