<?php

namespace AppBundle\Controller\Admin\Base;

use AppBundle\Filter\Base\Filter;
use AppBundle\Filter\Common\Base\BaseFilter;
use AppBundle\Filter\Common\Base\SimpleFilter;
use AppBundle\Form\Filter\Admin\Base\SimpleFilterType;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

abstract class SimpleController extends BaseController {
	// ---------------------------------------------------------------------------
	// Internal actions
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @param Request $request        	
	 * @param BaseFormType $form        	
	 */
	protected function listFormActionInternal(Request $request, Form $form, BaseFilter $filter, array $listItems) {
		if ($form->get('imPublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'infomarket', 1);
		}
		
		if ($form->get('imUnpublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'infomarket', 0);
		}
		
		if ($form->get('ipPublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'infoprodukt', 1);
		}
		
		if ($form->get('ipUnpublishSelected')->isClicked()) {
			$data = $form->getData();
			$entries = $data->getEntries();
			$filter->setSelected($entries);
			$this->setValueForSelected($entries, 'infoprodukt', 0);
		}
		
		return parent::listFormActionInternal($request, $form, $filter, $listItems);
	}

	protected function setIMPublishedActionInternal(Request $request, $id) {
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

	protected function setIPPublishedActionInternal(Request $request, $id) {
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
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemKeyFields($item) {
		$fields = parent::getListItemKeyFields($item);
		
		$fields[] = $item['name'];
		
		return $fields;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getFilterManager($doctrine) {
		return new FilterManager(new SimpleFilter());
	}
	
	// ---------------------------------------------------------------------------
	// EntityType related
	// ---------------------------------------------------------------------------
	
	/**
	 *
	 * @return FilterFormType
	 */
	protected function getFilterFormType() {
		return SimpleFilterType::class;
	}
	
	// ---------------------------------------------------------------------------
	// Routes
	// ---------------------------------------------------------------------------
	protected function getSetInfomarketRoute() {
		return $this->getIndexRoute() . '_set_infomarket';
	}

	protected function getSetInfoproduktRoute() {
		return $this->getIndexRoute() . '_set_infoprodukt';
	}
}