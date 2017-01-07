<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Form\Editor\Base\SimpleEntityEditorType;
use AppBundle\Form\Filter\Base\SimpleEntityFilterType;
use AppBundle\Form\Lists\Base\SimpleEntityListType;
use AppBundle\Manager\Filter\Base\SimpleEntityFilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;



abstract class SimpleEntityController extends BaseEntityController
{
	//---------------------------------------------------------------------------
	// Internal actions
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request
	 * @param BaseFormType $form
	 */
	protected function listFormActionInternal(Request $request, Form $form, BaseEntityFilter $filter, $allEntries) {
		
		if ($form->get('imPublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$this->setIMPublishedSelected($entries, true);
	
			return $this->redirectToReferer($request);
		}
	
		if ($form->get('imUnpublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$this->setIMPublishedSelected($entries, false);
	
			return $this->redirectToReferer($request);
		}
		
		if ($form->get('ipPublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$this->setIPPublishedSelected($entries, true);
		
			return $this->redirectToReferer($request);
		}
		
		if ($form->get('ipUnpublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$this->setIPPublishedSelected($entries, false);
		
			return $this->redirectToReferer($request);
		}
	
		return parent::listFormActionInternal($request, $form, $filter, $allEntries);
	}
	
	protected function setIMPublishedActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getSetInfomarketRoute());
		$params = $this->getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$infomarket = $request->get('value', false);
	
		$em = $this->getDoctrine()->getManager();
	
		$entry->setInfomarket($infomarket);
		$em->persist($entry);
		$em->flush();
	
		return $this->redirectToReferer($request);
	}
	
	protected function setIPPublishedActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getSetInfoproduktRoute());
		$params = $this->getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$infoprodukt = $request->get('value', false);
	
		$em = $this->getDoctrine()->getManager();
	
		$entry->setInfoprodukt($infoprodukt);
		$em->persist($entry);
		$em->flush();
	
		return $this->redirectToReferer($request);
	}
	
	//TODO should be moved to FeaturedEntityController ???
	protected function setFeaturedActionInternal(Request $request, $id)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$params = $this->createParams($this->getSetFeaturedRoute());
		$params = $this->getEditParams($request, $params, $id);
	
		$viewParams = $params['viewParams'];
		$entry = $viewParams['entry'];
	
		$featured = $request->get('value', false);
	
		$em = $this->getDoctrine()->getManager();
	
		$entry->setFeatured($featured);
		$em->persist($entry);
		$em->flush();
	
		return $this->redirectToReferer($request);
	}
	
	//---------------------------------------------------------------------------
	// Internal logic
	//---------------------------------------------------------------------------
	
	/**
	 *
	 * @param unknown $entries
	 * @param unknown $published
	 */
	protected function setIMPublishedSelected($entries, $published)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$em = $this->getDoctrine()->getManager();
	
		foreach ($entries as $entry) {
			$entry->setInfomarket($published);
			$em->persist($entry);
		}
	
		$em->flush();
	}
	
	/**
	 *
	 * @param unknown $entries
	 * @param unknown $published
	 */
	protected function setIPPublishedSelected($entries, $published)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		$em = $this->getDoctrine()->getManager();
	
		foreach ($entries as $entry) {
			$entry->setInfoprodukt($published);
			$em->persist($entry);
		}
	
		$em->flush();
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getFilterManager($doctrine) {	
		return new SimpleEntityFilterManager($doctrine);
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \AppBundle\Controller\Admin\Base\AdminController::getEditorFormType()
	 */
	protected function getEditorFormType() {
		return SimpleEntityEditorType::class;
	}
	
	/**
	 *
	 * @return FilterFormType
	 */
	protected function getFilterFormType() {
		return SimpleEntityFilterType::class;
	}
	
	/**
	 *
	 * @return BaseEntityListType
	 */
	protected function getListFormType() {
		return SimpleEntityListType::class;
	}
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getDeleteRole() {
		return 'ROLE_ADMIN';
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getSetInfomarketRoute()
	{
		return $this->getIndexRoute() . '_set_infomarket';
	}
	
	protected function getSetInfoproduktRoute()
	{
		return $this->getIndexRoute() . '_set_infoprodukt';
	}
	
	//TODO should be moved to FeaturedEntityController ???
	protected function getSetFeaturedRoute()
	{
		return $this->getIndexRoute() . 'set_featured';
	}
}