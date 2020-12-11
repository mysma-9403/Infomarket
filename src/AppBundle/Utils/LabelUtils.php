<?php

namespace AppBundle\Utils;

class LabelUtils {

	const LABEL = 'label.';

	public static function getLabel($string) {
		return self::LABEL . $string;
	}
}