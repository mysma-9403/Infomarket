<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\Magazine;
use AppBundle\Entity\MagazineBranchAssignment;
use AppBundle\Entity\Branch;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Utils\FormUtils;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\Editor\Transformer\MagazineToNumberTransformer;
use AppBundle\Repository\Admin\Main\MagazineRepository;
use AppBundle\Form\Editor\Transformer\BranchToNumberTransformer;

class MagazineBranchAssignmentEditorType extends BaseEntityEditorType
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
	
		/** @var MagazineRepository $magazineRepository */
		$magazineRepository = $this->em->getRepository(Magazine::class);
		$magazines = $magazineRepository->findFilterItems();
		
		/** @var BranchRepository $branchRepository */
		$branchRepository = $this->em->getRepository(Branch::class);
		$branches = $branchRepository->findFilterItems();
	
		$builder
		->add('magazine', ChoiceType::class, array(
				'choices' 		=> $magazines,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('branch', ChoiceType::class, array(
				'choices'		=> $branches,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('magazine')->addModelTransformer(new MagazineToNumberTransformer($this->em));
		$builder->get('branch')->addModelTransformer(new BranchToNumberTransformer($this->em));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return MagazineBranchAssignment::class;
	}
}