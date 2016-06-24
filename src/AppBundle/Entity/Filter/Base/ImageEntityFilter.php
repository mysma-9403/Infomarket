<?php

namespace AppBundle\Entity\Filter\Base;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;

class ImageEntityFilter extends SimpleEntityFilter {

	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->withImage)
			$expressions[] = "e.image IS NOT NULL";
		
		return $expressions;
	}

	/**
	 *
	 * @var boolean
	 */
	private $withImage;
	
	/**
	 * Set with image
	 *
	 * @param array $withImage
	 *
	 * @return ImageEntityFilter
	 */
	public function setWithImage($withImage)
	{
		$this->withImage = $withImage;
	
		return $this;
	}
	
	/**
	 * Is with image
	 *
	 * @return boolean
	 */
	public function isWithImage()
	{
		return $this->withImage;
	}
}