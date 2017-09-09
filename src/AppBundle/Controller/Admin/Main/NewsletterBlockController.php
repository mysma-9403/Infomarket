<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\SimpleController;
use AppBundle\Entity\Main\NewsletterBlock;
use AppBundle\Entity\Main\NewsletterBlockTemplate;
use AppBundle\Entity\Main\NewsletterPage;
use AppBundle\Filter\Common\Main\NewsletterBlockFilter;
use AppBundle\Form\Editor\Admin\Main\NewsletterBlockEditorType;
use AppBundle\Form\Filter\Admin\Main\NewsletterBlockFilterType;
use AppBundle\Manager\Entity\Common\Main\NewsletterBlockManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockController extends SimpleController {
	
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
		return $this->get('app.misc.provider.subname_list_items_provider');
	}
	
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
		
		$this->addEntityChoicesFormOption($options, NewsletterPage::class, 'newsletterPages');
		$this->addEntityChoicesFormOption($options, NewsletterBlockTemplate::class, 'newsletterBlockTemplates');
		
		return $options;
	}

	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		$this->addEntityChoicesFormOption($options, NewsletterPage::class, 'newsletterPage');
		$this->addEntityChoicesFormOption($options, NewsletterBlockTemplate::class, 'newsletterBlockTemplate');
		
		return $options;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(NewsletterBlockManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterBlockFilter());
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
		return NewsletterBlock::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return NewsletterBlockEditorType::class;
	}

	protected function getFilterFormType() {
		return NewsletterBlockFilterType::class;
	}
}