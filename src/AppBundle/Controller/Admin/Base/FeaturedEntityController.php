<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Filter\Admin\Base\AuditFilter;
use AppBundle\Filter\Admin\Base\FeaturedEntityFilter;
use AppBundle\Filter\Base\Filter;
use AppBundle\Manager\Filter\Base\FilterManager;
use AppBundle\Repository\Admin\Base\FeaturedEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;



abstract class FeaturedEntityController extends ImageEntityController
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
		
		if ($form->get('setFeaturedSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setFeaturedSelected($entries, 1);
		}
	
		if ($form->get('setNotFeaturedSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setFeaturedSelected($entries, 0);
		}
	
		return parent::listFormActionInternal($request, $form, $filter, $listItems);
	}
	
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
	 * @param array $entries
	 * @param boolean $published
	 */
	protected function setFeaturedSelected($items, $featured)
	{
		$this->denyAccessUnlessGranted($this->getEditRole(), null, 'Unable to access this page!');
	
		if(count($items) > 0) {
			/** @var FeaturedEntityRepository $repository */
			$repository = $this->getEntityRepository();
			$repository->setFeatured($items, $featured);
		}
	}
	
	//---------------------------------------------------------------------------
	// Managers
	//---------------------------------------------------------------------------
	
	protected function getFilterManager($doctrine) {	
		return new FilterManager(new FeaturedEntityFilter());
	}
	
	//---------------------------------------------------------------------------
	// Routes
	//---------------------------------------------------------------------------
	
	protected function getSetFeaturedRoute()
	{
		return $this->getIndexRoute() . 'set_featured';
	}
}