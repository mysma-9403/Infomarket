<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class IsArticleTagAssignmentUnique extends Constraint
{
    public $message = '';
}