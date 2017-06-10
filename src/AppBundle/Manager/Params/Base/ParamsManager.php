<?php

namespace AppBundle\Manager\Params\Base;

use AppBundle\Utils\StringUtils;
use Symfony\Component\HttpFoundation\Request;

class ParamsManager {
	
	//TODO replace by repository
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
		//TODO replace by repository
		$repository = $this->doctrine->getRepository($paramClass);
		$paramName = StringUtils::getClassName($paramClass);
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
		//TODO replace by repository
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
		//TODO replace by repository
		$repository = $this->doctrine->getRepository($paramClass);
		return $repository->findSelected($filter);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param class $paramClass
	 * @param mixed $template
	 *
	 * @return mixed
	 */
	protected function getParamId($request, $paramClass, $template = null)
	{
		$paramName = StringUtils::getClassName($paramClass);
		$id = $request->get($paramName, null);
		
		if($id !== null) return $id;
		
		if(array_key_exists($paramName, $this->lastRouteParams)) {
			return $this->lastRouteParams[$paramName];
		}
		
		return $template;
	}
	
	/**
	 *
	 * @param Request $request
	 * @param string $paramName
	 * @param mixed $template
	 *
	 * @return mixed
	 */
	protected function getParamIdByName($request, $paramName, $template = null)
	{
		$id = $request->get($paramName, null);
	
		if($id !== null) return $id;
	
		if(array_key_exists($paramName, $this->lastRouteParams)) {
			return $this->lastRouteParams[$paramName];
		}
	
		return $template;
	}
}