<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Filter\Admin\Base\SimpleEntityFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Form\Filter\Admin\Base\SimpleEntityFilterType;
use AppBundle\Form\Lists\Base\SimpleEntityListType;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Base\SimpleRepository;
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
	protected function listFormActionInternal(Request $request, Form $form, AuditFilter $filter, array $listItems) {
		
		if ($form->get('imPublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setIMPublishedSelected($entries, 1);
		}
	
		if ($form->get('imUnpublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setIMPublishedSelected($entries, 0);
		}
		
		if ($form->get('ipPublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setIPPublishedSelected($entries, 1);
		}
		
		if ($form->get('ipUnpublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setIPPublishedSelected($entries, 0);
		}
	
		return parent::listFormActionInternal($request, $form, $filter, $listItems);
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
	
	protected function getListItemKeyFields($item) {
		$fields = parent::getListItemKeyFields($item);
		
		$fields[] = $item['name'];
		
		return $fields;
	}
	
	/**
	 *
	 * @param unknown $entries
	 * @param unknown $published
	 */
	protected function setIMPublishedSelected($items, $published)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		if(count($items) > 0) {
			/** @var SimpleRepository $repository */
			$repository = $this->getRepository();
			$repository->setIMPublished($items, $published);
		}
	}
	
	/**
	 *
	 * @param unknown $entries
	 * @param unknown $published
	 */
	protected function setIPPublishedSelected($items, $published)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		if(count($items) > 0) {
			/** @var SimpleRepository $repository */
			$repository = $this->getRepository();
			$repository->setIPPublished($items, $published);
		}
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getFilterManager($doctrine) {	
		return new FilterManager(new SimpleEntityFilter());
	}
	
	//---------------------------------------------------------------------------
	// EntityType related
	//---------------------------------------------------------------------------
	
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