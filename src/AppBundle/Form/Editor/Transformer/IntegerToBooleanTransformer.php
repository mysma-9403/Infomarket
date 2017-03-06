<?php

namespace AppBundle\Form\Editor\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

class IntegerToBooleanTransformer implements DataTransformerInterface
{
	/**
	 * Transforms an integer to a boolean.
	 *
	 * @param  integer $value
	 * @return boolean
	 */
	public function transform($value)
	{
		if (!$value) {
			return;
		}
		return $value > 0;
	}

	/**
	 * Transforms a boolean to an integer.
	 *
	 * @param  boolean $value
	 * @return integer
	 */
	public function reverseTransform($value)
	{
		if (!$value) {
			return;
		}
		return $value ? 1 : 0;
	}
}