<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Entity\Assignments\NewsletterBlockAdvertAssignment;
use AppBundle\Filter\Common\Assignments\NewsletterBlockAdvertAssignmentFilter;
use AppBundle\Form\Editor\Admin\Assignments\NewsletterBlockAdvertAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\NewsletterBlockAdvertAssignmentFilterType;
use AppBundle\Manager\Entity\Common\Assignments\NewsletterBlockAdvertAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class NewsletterBlockAdvertAssignmentController extends AssignmentController {
	
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
		return $this->get('app.misc.provider.form_options.filter.assignment.newsletter_block_advert');
	}

	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.assignment.newsletter_block_advert');
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(NewsletterBlockAdvertAssignmentManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new NewsletterBlockAdvertAssignmentFilter());
	}
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return NewsletterBlockAdvertAssignment::class;
	}

	protected function getEditorFormType() {
		return NewsletterBlockAdvertAssignmentEditorType::class;
	}

	protected function getFilterFormType() {
		return NewsletterBlockAdvertAssignmentFilterType::class;
	}
}