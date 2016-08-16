<?php

namespace AppBundle\Validator\Constraints;

use AppBundle\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsArticleTagAssignmentUniqueValidator extends ConstraintValidator
{
	/**
	 *
	 * @var Registry
	 */
	private $doctrine;
	
	public function __construct(Registry $doctrine)  {
		$this->doctrine = $doctrine;
	}
	
	public function validate($value, Constraint $constraint)
	{
		if ($value) {
			$tagRepository = $this->doctrine->getRepository(Tag::class);
			$tag = $tagRepository->findOneBy(['name' => $value]);
			
			if($tag) {
				$this->context->buildViolation($constraint->message)
				->addViolation();
			}
		}
	}
}