<?php

namespace AppBundle\Filter\Base;

use Symfony\Component\HttpFoundation\Request;

class Filter {

	const FALSE_VALUES = 0;

	const TRUE_VALUES = 1;

	const ALL_VALUES = 2;

	/**
	 * Filter name e.g.
	 * product_filter_
	 *
	 * @var string
	 */
	protected $filterName = '';

	/**
	 * Init context params.
	 *
	 * @param array $viewParams        	
	 */
	public function initContextParams(array $contextParams) {
	}

	/**
	 *
	 * @param Request $request        	
	 */
	public function initRequestValues(Request $request) {
	}

	/**
	 */
	public function clearRequestValues() {
	}

	/**
	 *
	 * @return array
	 */
	public function getRequestValues() {
		return array();
	}

	/**
	 *
	 * @return string
	 */
	public function getFilterName() {
		return $this->filterName;
	}

	protected function getRequestValue(Request $request, $name, $template = null) {
		$key = $this->getKey($name);
		return $request->get($key, $template);
	}

	protected function setRequestValue(array &$values, $name, $value) {
		if ($value) {
			$values[$this->getKey($name)] = $value;
		}
	}

	protected function getRequestArray(Request $request, $name, $template = array()) {
		$key = $this->getKey($name);
		return $request->get($key, $template);
	}

	protected function setRequestArray(array &$values, $name, $array) {
		if ($array && count($array) > 0) {
			$values[$this->getKey($name)] = $array;
		}
	}

	protected function getRequestBool(Request $request, $name, $template = self::ALL_VALUES) {
		$key = $this->getKey($name);
		return $request->get($key, $template);
	}

	protected function setRequestBool(array &$values, $name, $value) {
		if ($value != self::ALL_VALUES) {
			$values[$this->getKey($name)] = $value;
		}
	}

	protected function getRequestSimpleBool(Request $request, $name, $template = false) {
		$key = $this->getKey($name);
		return $request->get($key, $template) == 1 ? true : false;
	}

	protected function setRequestSimpleBool(array &$values, $name, $value) {
		$values[$this->getKey($name)] = $value ? 1 : 0;
	}

	protected function getRequestString(Request $request, $name, $template = null) {
		$key = $this->getKey($name);
		return $request->get($key, $template);
	}

	protected function setRequestString(array &$values, $name, $string) {
		if ($string && strlen($string) > 0) {
			$values[$this->getKey($name)] = $string;
		}
	}

	protected function getRequestTime(Request $request, $name, $template = null) {
		$key = $this->getKey($name);
		$time = $request->get($key, $template);
		return $time ? new \DateTime($time) : null;
	}

	protected function setRequestTime(array &$values, $name, $time) {
		if ($time) {
			$values[$this->getKey($name)] = $time->format('d-m-Y H:i');
		}
	}

	/**
	 * Get request param key.
	 *
	 * @param string $name
	 *        	param name
	 * @return string
	 */
	protected function getKey($name) {
		return $this->filterName . $name;
	}
}