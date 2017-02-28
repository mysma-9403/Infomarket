<?php

namespace AppBundle\Form\Other;

use AppBundle\Entity\Other\ArticleTagAssignments;
use AppBundle\Entity\Tag;
use AppBundle\Form\Base\BaseType;
use AppBundle\Repository\Admin\Main\TagRepository;
use AppBundle\Utils\FormUtils;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleTagAssignmentsType extends BaseType
{
	protected $em;
	
	public function __construct(ObjectManager $em)
	{
		$this->em = $em;
	}
	
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
		
		/** @var TagRepository $tagRepository */
		$tagRepository = $this->em->getRepository(Tag::class);
		$tags = $tagRepository->findFilterItems();
		
		$builder
		->add('tags', ChoiceType::class, array(
				'choices' 		=> $tags,
				'choice_label' 	=> function ($value, $key, $index) { return FormUtils::getListLabel($value, $key, $index); },
				'choice_translation_domain' => false,
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true
		))
		->add('tagsString', null, array(
				'required' => false
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
		return ArticleTagAssignments::class;
	}
}