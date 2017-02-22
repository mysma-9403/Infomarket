<?php

namespace AppBundle\Form\Editor\Assignments;

use AppBundle\Entity\NewsletterGroup;
use AppBundle\Entity\NewsletterUser;
use AppBundle\Entity\NewsletterUserNewsletterGroupAssignment;
use AppBundle\Form\Editor\Base\BaseEntityEditorType;
use AppBundle\Form\Editor\Transformer\NewsletterGroupToNumberTransformer;
use AppBundle\Form\Editor\Transformer\NewsletterUserToNumberTransformer;
use AppBundle\Repository\Admin\Main\NewsletterUserRepository;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsletterUserNewsletterGroupAssignmentEditorType extends BaseEntityEditorType
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
	
		/** @var NewsletterUserRepository $newsletterUserRepository */
		$newsletterUserRepository = $this->em->getRepository(NewsletterUser::class);
		$newsletterUsers = $newsletterUserRepository->findFilterItems();
		
		/** @var NewsletterGroupRepository $newsletterGroupRepository */
		$newsletterGroupRepository = $this->em->getRepository(NewsletterGroup::class);
		$newsletterGroups = $newsletterGroupRepository->findFilterItems();
	
		$builder
		->add('newsletterUser', ChoiceType::class, array(
				'choices' 		=> $newsletterUsers,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		->add('newsletterGroup', ChoiceType::class, array(
				'choices'		=> $newsletterGroups,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => false
		))
		;
		
		$builder->get('newsletterUser')->addModelTransformer(new NewsletterUserToNumberTransformer($this->em));
		$builder->get('newsletterGroup')->addModelTransformer(new NewsletterGroupToNumberTransformer($this->em));
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\ImageEntityType::getEntityType()
	 */
	protected function getEntityType() {
		return NewsletterUserNewsletterGroupAssignment::class;
	}
}