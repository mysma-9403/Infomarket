<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkFieldBetterThanTypesFactory;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkFieldFieldTypesFactory;
use AppBundle\Factory\Common\Choices\Enum\BenchmarkFieldNoteTypesFactory;
use AppBundle\Filter\Admin\Main\BenchmarkFieldFilter;
use AppBundle\Form\Editor\Admin\Main\BenchmarkFieldEditorType;
use AppBundle\Form\Filter\Admin\Main\BenchmarkFieldFilterType;
use AppBundle\Manager\Entity\Common\BenchmarkFieldManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class BenchmarkFieldController extends BaseEntityController {
	
	//---------------------------------------------------------------------------
	// Actions
	//---------------------------------------------------------------------------
	/**
	 * 
	 * @param Request $request
	 * @param integer $page
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page)
	{
		return $this->indexActionInternal($request, $page);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id)
	{
		return $this->showActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request)
	{
		return $this->newActionInternal($request);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id)
	{
		return $this->copyActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id)
	{
		return $this->editActionInternal($request, $id);
	}
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id)
	{
		return $this->deleteActionInternal($request, $id);
	}
	
	//------------------------------------------------------------------------
	// Internal logic
	//------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		$this->addEntityChoicesFormOption($options, Category::class, 'categories');
		
		$this->addFactoryChoicesFormOption($options, BenchmarkFieldFieldTypesFactory::class, 'fieldTypes');
		
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		$this->addEntityChoicesFormOption($options, Category::class, 'category');
		
		$this->addFactoryChoicesFormOption($options, BenchmarkFieldFieldTypesFactory::class, 'fieldType');
		$this->addFactoryChoicesFormOption($options, BenchmarkFieldBetterThanTypesFactory::class, 'betterThanType');
		$this->addFactoryChoicesFormOption($options, BenchmarkFieldNoteTypesFactory::class, 'noteType');
		
		return $options;
	}
	
	protected function getListItemKeyFields($item) {
		return [$item['id'], $item['fieldName']];
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		return new BenchmarkFieldManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new BenchmarkFieldFilter());
	}
	
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	protected function getEntityType() {
		return BenchmarkField::class;
	}
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	protected function getEditorFormType() {
		return BenchmarkFieldEditorType::class;
	}
	
	protected function getFilterFormType() {
		return BenchmarkFieldFilterType::class;
	}
}