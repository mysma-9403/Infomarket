<?php

namespace AppBundle\Form\Filter\Admin\Other;

use AppBundle\Filter\Admin\Other\SendNewsletterFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Base\BaseType;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Repository\Admin\Main\NewsletterGroupRepository;
use AppBundle\Entity\NewsletterGroup;

class SendNewsletterFilterType extends BaseType
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
		
		$groupRepository = new NewsletterGroupRepository($this->em, $this->em->getClassMetadata(NewsletterGroup::class));
		$groups = $groupRepository->findFilterItems();
		
		$builder
		->add('groups', ChoiceType::class, array(
				'choices'		=> $groups,
				'choice_label' => function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('embedImages', CheckboxType::class, array(
				'required'		=> false
		))
		->add('forceSend', CheckboxType::class, array(
				'required'		=> false
		))
		;
	}
	
	protected function addActions(FormBuilderInterface $builder, array $options) {
		$builder
		->add('submit', SubmitType::class)
		;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Entity\Filter\Base\SimpleEntityFilterType::getEntityType()
	 */
	protected function getEntityType() {
		return SendNewsletterFilter::class;
	}
}