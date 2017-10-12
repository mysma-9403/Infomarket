<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\BaseController;
use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Filter\Common\Main\BenchmarkFieldFilter;
use AppBundle\Form\Editor\Admin\Main\BenchmarkFieldEditorType;
use AppBundle\Form\Filter\Admin\Main\BenchmarkFieldFilterType;
use AppBundle\Manager\Entity\Common\Main\BenchmarkFieldManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\Admin\Main\ProductNoteRepository;

class BenchmarkFieldController extends BaseController {
	
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
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.main.benchmark_field');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.main.benchmark_field');
	}
	
	// ------------------------------------------------------------------------
	// Internal logic
	// ------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.benchmark_field_list_items_provider');
	}

	protected function prepareEntry($request, &$entry, $params) {
		parent::prepareEntry($request, $entry, $params);
		/** @var BenchmarkField $entry */
		
		if ($this->shouldInvalidateProductNotes($entry) && $this->isCreated($entry)) {
			$this->invalidateProductNotes($entry);
		}
	}

	protected function deleteMore($entry) {
		$result = parent::deleteMore($entry);
		/** @var BenchmarkField $entry */
		
		if ($this->shouldInvalidateProductNotes($entry)) {
			$this->invalidateProductNotes($entry);
		}
		
		return $result;
	}
	
	protected function shouldInvalidateProductNotes($entry) {
		return $entry->getNoteType() != BenchmarkField::NONE_NOTE_TYPE && $entry->getNoteWeight() > 0;
	}

	protected function invalidateProductNotes($entry) {
		/** @var ProductNoteRepository $productNoteRepository */
		$productNoteRepository = $this->get(ProductNoteRepository::class);
		
		$categories = [$entry->getCategory()->getId()];
		$productNoteRepository->invalidateItemsByCategories($categories);
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(BenchmarkFieldManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new BenchmarkFieldFilter());
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return BenchmarkField::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return BenchmarkFieldEditorType::class;
	}

	protected function getFilterFormType() {
		return BenchmarkFieldFilterType::class;
	}
}