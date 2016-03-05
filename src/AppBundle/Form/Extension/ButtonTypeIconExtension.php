<?php

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\Extension\Core\Type\ButtonType;

class ButtonTypeIconExtension extends AbstractIconExtension
{
    /**
     * {@inheritDoc}
     */
    public function getExtendedType()
    {
        return ButtonType::class;
    }
}