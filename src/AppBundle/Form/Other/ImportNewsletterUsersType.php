<?php

namespace AppBundle\Form\Other;

use AppBundle\Entity\Other\ImportNewsletterUsers;
use AppBundle\Form\Base\BaseType;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Repository\Admin\Main\NewsletterGroupRepository;
use AppBundle\Entity\NewsletterGroup;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Utils\FormUtils;

class ImportNewsletterUsersType extends BaseType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		/** @var NewsletterGroupRepository $newsletterGroupRepository */
		$newsletterGroupRepository = $this->em->getRepository(NewsletterGroup::class);
		$newsletterGroups = $newsletterGroupRepository->findFilterItems();
		
		$builder
		->add('importFile', ElFinderType::class, array(
				'instance'=>'newsletter_users',
				'required' => true
		))
		->add('newsletterGroups', ChoiceType::class, array(
				'choices' 		=> $newsletterGroups,
				'choice_label' 	=> function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> true,
				'expanded'      => false,
				'multiple'      => true
		))
		;
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
		->add('submit', SubmitType::class)
		;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getEntityType() {
		return ImportNewsletterUsers::class;
	}
}