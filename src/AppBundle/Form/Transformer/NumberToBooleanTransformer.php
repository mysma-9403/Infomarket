<?php

namespace AppBundle\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

class NumberToBooleanTransformer implements DataTransformerInterface {

	/**
	 * Transforms number to boolean.
	 *
	 * @param mixed $value        	
	 * @return boolean
	 */
	public function transform($value) {
		if (! $value) {
			return;
		}
		return $value > 0;
	}

	/**
	 * Transforms boolean to number.
	 *
	 * @param boolean $value        	
	 * @return mixed
	 */
	public function reverseTransform($value) {
		if (! $value) {
			return;
		}
		return $value ? 1 : 0;
	}
}