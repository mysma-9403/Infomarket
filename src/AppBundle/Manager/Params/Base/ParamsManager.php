<?php

namespace AppBundle\Manager\Params\Base;

use AppBundle\Repository\Base\BaseRepository;
use AppBundle\Utils\ClassUtils;
use Symfony\Component\HttpFoundation\Request;

class ParamsManager {

	protected $doctrine;

	public function __construct($doctrine) {
		$this->doctrine = $doctrine;
	}

	/**
	 *
	 * @param Request $request        	
	 * @param class $paramClass        	
	 * @param object $template        	
	 *
	 * @return object
	 */
	public function getParamByClass(Request $request, $class, $template = null) {
		$name = ClassUtils::getUnderscoreName($class);
		
		return $this->getParamByName($request, $class, $name, $template);
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
	public function getParamByName(Request $request, $class, $name, $template = null) {
		/** @var BaseRepository $repository */
		$repository = $this->doctrine->getRepository($class);
		
		$id = $request->get($name, $template);
		
		return $id ? $repository->find($id) : null;
	}

	/**
	 *
	 * @param Request $request        	
	 * @param class $paramClass        	
	 * @param mixed $template        	
	 *
	 * @return mixed
	 */
	public function getIdByClass(Request $request, $class, $template = null) {
		$name = ClassUtils::getUnderscoreName($class);
		
		return $this->getIdByName($request, $name, $template);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param string $paramName        	
	 * @param mixed $template        	
	 *
	 * @return mixed
	 */
	public function getIdByName(Request $request, $name, $template = null) {
		$id = $request->get($name, null);
		
		return $id ? $id : $template;
	}
}