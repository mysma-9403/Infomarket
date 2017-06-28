<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\BaseEntityController;
use AppBundle\Controller\Admin\Base\SimpleEntityController;
use AppBundle\Entity\BenchmarkField;
use AppBundle\Entity\Category;
use AppBundle\Filter\Admin\Main\BenchmarkFieldFilter;
use AppBundle\Form\Editor\Main\BenchmarkFieldEditorType;
use AppBundle\Form\Filter\Admin\Main\BenchmarkFieldFilterType;
use AppBundle\Manager\Entity\Common\BenchmarkFieldManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Main\CategoryRepository;
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
	
	protected function getFormOptions() {
		$options = parent::getFormOptions();
	
		/** @var CategoryRepository $categoryRepository */
		$categoryRepository = $this->getDoctrine()->getRepository(Category::class);
		$options['categories'] = $categoryRepository->findFilterItems();
	
		return $options;
	}
	
	protected function getListItemKeyFields($item) {
		return [$item['id'], $item['fieldName']];
	}
	
	protected function prepareEntry($request, &$entry, $params) {
		parent::prepareEntry($request, $entry, $params);
		/** @var BenchmarkField $entry */
		switch($entry->getFieldType()) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
				$entry->setValueType(BenchmarkField::DECIMAL_VALUE_TYPE);
				$entry->setFilterType(BenchmarkField::DECIMAL_FILTER_TYPE);
				break;
			case BenchmarkField::INTEGER_FIELD_TYPE:
				$entry->setValueType(BenchmarkField::INTEGER_VALUE_TYPE);
				$entry->setFilterType(BenchmarkField::INTEGER_FILTER_TYPE);
				break;
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$entry->setValueType(BenchmarkField::INTEGER_VALUE_TYPE);
				$entry->setFilterType(BenchmarkField::BOOLEAN_FILTER_TYPE);
				break;
			case BenchmarkField::STRING_FIELD_TYPE:
				$entry->setValueType(BenchmarkField::STRING_VALUE_TYPE);
				$entry->setFilterType(BenchmarkField::STRING_FILTER_TYPE);
				break;
			case BenchmarkField::SINGLE_ENUM_FIELD_TYPE:
				$entry->setValueType(BenchmarkField::STRING_VALUE_TYPE);
				$entry->setFilterType(BenchmarkField::SINGLE_ENUM_FILTER_TYPE);
				break;
			case BenchmarkField::MULTI_ENUM_FIELD_TYPE:
				$entry->setValueType(BenchmarkField::STRING_VALUE_TYPE);
				$entry->setFilterType(BenchmarkField::MULTI_ENUM_FILTER_TYPE);
				break;
		}
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
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getEntityType()
	 */
	protected function getEntityType() {
		return BenchmarkField::class;
	}
	
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return BenchmarkFieldEditorType::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFilterFormType()
	 */
	protected function getFilterFormType() {
		return BenchmarkFieldFilterType::class;
	}
}