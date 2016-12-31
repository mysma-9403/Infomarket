<?php

namespace AppBundle\Manager\Params\Base;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Utils\ClassUtils;
use AppBundle\Entity\Filter\Base\BaseEntityFilter;

class ParamsManager {
	
	protected $doctrine;
	
	public function __construct($doctrine) {
		$this->doctrine = $doctrine;
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param array $params
	 * 
	 * @return array
	 */
	public function getParams(Request $request, array $params) {}
	
	/**
	 * 
	 * @param Request $request
	 * @param class $paramClass
	 * @param object $template
	 * 
	 * @return object
	 */
	protected function getParam($request, $paramClass, $template = null)
	{
		$repository = $this->doctrine->getRepository($paramClass);
		$paramName = ClassUtils::getClassName($paramClass);
		$id = $request->get($paramName, $template);
		return $id ? $repository->find($id) : null;
	}
	
	/**
	 *
	 * @param Request $request
	 * @param class $paramClass
	 * @param string $name
	 * @param object $template
	 * 
	 * @return object
	 */
	protected function getParamWithName($request, $paramClass, $name, $template = null)
	{
		$repository = $this->doctrine->getRepository($paramClass);
		$id = $request->get($name, $template);
		return $id ? $repository->find($id) : null;
	}
	
	/**
	 *
	 * @param class $paramClass
	 * @param BaseEntityFilter $filter
	 * 
	 * @return object[]
	 */
	protected function getParamList($paramClass, $filter)
	{
		$repository = $this->doctrine->getRepository($paramClass);
		return $repository->findSelected($filter);
	}
}