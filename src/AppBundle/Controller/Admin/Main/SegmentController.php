<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\ImageController;
use AppBundle\Entity\Main\Segment;
use AppBundle\Factory\Common\Choices\Bool\InfomarketChoicesFactory;
use AppBundle\Factory\Common\Choices\Bool\InfoproduktChoicesFactory;
use AppBundle\Filter\Common\Main\SegmentFilter;
use AppBundle\Form\Editor\Admin\Main\SegmentEditorType;
use AppBundle\Form\Filter\Admin\Main\SegmentFilterType;
use AppBundle\Form\Lists\Base\InfoMarketListType;
use AppBundle\Manager\Entity\Common\Main\SegmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class SegmentController extends ImageController {
	
	// ---------------------------------------------------------------------------
	// Actions
	// ---------------------------------------------------------------------------
	/**
	 *
	 * @param Request $request        	
	 * @param integer $page        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function indexAction(Request $request, $page) {
		return $this->indexActionInternal($request, $page);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function showAction(Request $request, $id) {
		return $this->showActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function newAction(Request $request) {
		return $this->newActionInternal($request);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function copyAction(Request $request, $id) {
		return $this->copyActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function editAction(Request $request, $id) {
		return $this->editActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function deleteAction(Request $request, $id) {
		return $this->deleteActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIMPublishedAction(Request $request, $id) {
		return $this->setIMPublishedActionInternal($request, $id);
	}

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setIPPublishedAction(Request $request, $id) {
		return $this->setIPPublishedActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}

	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
		
		$this->addFactoryChoicesFormOption($options, InfomarketChoicesFactory::class, 'infomarket');
		$this->addFactoryChoicesFormOption($options, InfoproduktChoicesFactory::class, 'infoprodukt');
		
		return $options;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(SegmentManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new SegmentFilter());
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return Segment::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return SegmentEditorType::class;
	}

	protected function getFilterFormType() {
		return SegmentFilterType::class;
	}

	protected function getListFormType() {
		return InfoMarketListType::class;
	}
}