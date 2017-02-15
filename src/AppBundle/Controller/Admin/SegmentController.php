<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Controller\Admin\Base\ImageEntityController;
use AppBundle\Entity\Segment;
use AppBundle\Form\Editor\SegmentEditorType;
use AppBundle\Manager\Entity\Common\SegmentManager;
use Symfony\Component\HttpFoundation\Request;

class SegmentController extends ImageEntityController {
	
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
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getEntityManager($doctrine, $paginator) {
		return new SegmentManager($doctrine, $paginator);
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
		return Segment::class;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\SimpleEntityController::getFormType()
	 */
	protected function getEditorFormType() {
		return SegmentEditorType::class;
	}
}