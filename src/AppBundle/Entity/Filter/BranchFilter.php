<?php

namespace AppBundle\Entity\Filter;

use AppBundle;
use AppBundle\Entity\Filter\Base\ImageEntityFilter;
use AppBundle\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class BranchFilter extends ImageEntityFilter {
	
	/**
	 * 
	 * @var array
	 */
	protected $categories;
	
	public function __construct() {
		$this->filterName = 'branch_filter_';
	}
	
	public function initRequestValues(Request $request) {
		parent::initRequestValues($request);
		
		$categories = $request->get($this->getFilterName() . 'categories', array());
		$this->categories = $this->categoryRepository->findBy(array('id' => $categories));
	}
	
	public function clearRequestValues() {
		parent::clearRequestValues();
	
		$this->categories = array();
	}
	
	public function getRequestValues() {
		$values = parent::getRequestValues();
	
		if($this->categories) {
			$values[$this->getFilterName() . 'categories'] = $this->getIdValues($this->categories);
		}
	
		return $values;
	}
	
	/**
	 * Set branch categories
	 *
	 * @param array $categories
	 *
	 * @return BranchFilter
	 */
	public function setCategories($categories)
	{
		$this->categories = $categories;
	
		return $this;
	}
	
	/**
	 * Get branch categories
	 *
	 * @return array
	 */
	public function getCategories()
	{
		return $this->categories;
	}
}