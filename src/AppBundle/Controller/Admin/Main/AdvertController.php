<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\ImageEntityController;
use AppBundle\Entity\Advert;
use AppBundle\Entity\Category;
use AppBundle\Factory\Common\Choices\Bool\InfomarketChoicesFactory;
use AppBundle\Factory\Common\Choices\Bool\InfoproduktChoicesFactory;
use AppBundle\Factory\Common\Choices\Enum\AdvertLocationsFactory;
use AppBundle\Filter\Admin\Main\AdvertFilter;
use AppBundle\Form\Editor\Admin\Main\AdvertEditorType;
use AppBundle\Form\Filter\Admin\Main\AdvertFilterType;
use AppBundle\Form\Lists\Base\InfoMarketEntityListType;
use AppBundle\Manager\Entity\Common\AdvertManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use phpDocumentor\Reflection\Location;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends ImageEntityController {
	
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
	
	/**
	 * 
	 * @param Request $request
	 * @param integer $id
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id)
	{
		return $this->setIMPublishedActionInternal($request, $id);
	}
	
	/**
	 *
	 * @param Request $request
	 * @param integer $id
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id)
	{
		return $this->setIPPublishedActionInternal($request, $id);
	}
	
	//------------------------------------------------------------------------
	// Internal logic
	//------------------------------------------------------------------------
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
	
		$this->addEntityChoicesFormOption($options, Category::class, 'categories');
		
		$this->addFactoryChoicesFormOption($options, AdvertLocationsFactory::class, 'locations');
		
		$this->addFactoryChoicesFormOption($options, InfomarketChoicesFactory::class, 'infomarket');
		$this->addFactoryChoicesFormOption($options, InfoproduktChoicesFactory::class, 'infoprodukt');
	
		return $options;
	}
	
	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		$this->addFactoryChoicesFormOption($options, AdvertLocationsFactory::class, 'location');
		
		return $options;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminEntityController::deleteMore()
	 */
	protected function deleteMore($entry)
	{
		$em = $this->getDoctrine()->getManager();
		
		foreach ($entry->getAdvertCategoryAssignments() as $advertCategoryAssignment) {
			$em->remove($advertCategoryAssignment);
		}
		$em->flush();
		
		return array();
	}
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		return new AdvertManager($doctrine, $paginator);
	}
	
	protected function getFilterManager($doctrine) {
		return new FilterManager(new AdvertFilter());
	}
	
	
	//------------------------------------------------------------------------
	// EntityType related
	//------------------------------------------------------------------------
	
	protected function getEntityType() {
		return Advert::class;
	}
	
	//------------------------------------------------------------------------
	// Forms
	//------------------------------------------------------------------------
	
	protected function getEditorFormType() {
		return AdvertEditorType::class;
	}
	
	protected function getFilterFormType() {
		return AdvertFilterType::class;
	}
	
	protected function getListFormType() {
		return InfoMarketEntityListType::class;
	}
}