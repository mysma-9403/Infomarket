<?php

namespace AppBundle\Entity\Filter\Base;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class ImageEntityFilter extends SimpleEntityFilter {

	public function __construct(UserRepository $userRepository) {
		parent::__construct($userRepository);
		
		$this->filterName = 'image_filter_';
	
		$this->withImage = $this::ALL_VALUES;
	}
	
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
		
		$this->withImage = $request->get($this->getFilterName() . 'withImage', $this::ALL_VALUES);
	}
	
	protected function clearMoreQueryValues() {
		$this->withImage = $this::ALL_VALUES;
	}
	
	public function getValues() {
		$values = parent::getValues();
	
		if($this->withImage !== $this::ALL_VALUES) {
			$values[$this->getFilterName() . 'withImage'] = $this->withImage;
		}
	
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->withImage === $this::TRUE_VALUES) {
			$expressions[] = 'e.image IS NOT NULL';
		}
		else if($this->withImage === $this::FALSE_VALUES) {
			$expressions[] = 'e.image IS NULL';
		}
		
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