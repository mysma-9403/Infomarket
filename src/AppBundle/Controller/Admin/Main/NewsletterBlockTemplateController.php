<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\SimpleController;
use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Filter\Common\Main\NewsletterBlockTemplateFilter;
use AppBundle\Form\Editor\Admin\Main\NewsletterBlockTemplateEditorType;
use AppBundle\Form\Filter\Admin\Main\NewsletterBlockTemplateFilterType;
use AppBundle\Manager\Entity\Common\Main\NewsletterBlockTemplateManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockTemplateController extends SimpleController {
	
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
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(NewsletterBlockTemplateManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterBlockTemplateFilter());
	}
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getShowRole() {
		return 'ROLE_ADMIN';
	}

	protected function getEditRole() {
		return 'ROLE_ADMIN';
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return NewsletterBlockTemplate::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return NewsletterBlockTemplateEditorType::class;
	}

	protected function getFilterFormType() {
		return NewsletterBlockTemplateFilterType::class;
	}
}