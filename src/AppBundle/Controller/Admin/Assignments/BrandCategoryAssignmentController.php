<?php

namespace AppBundle\Controller\Admin\Assignments;

use AppBundle\Controller\Admin\Base\AssignmentController;
use AppBundle\Entity\Brand;
use AppBundle\Entity\BrandCategoryAssignment;
use AppBundle\Entity\Category;
use AppBundle\Filter\Admin\Assignments\BrandCategoryAssignmentFilter;
use AppBundle\Form\Editor\Admin\Assignments\BrandCategoryAssignmentEditorType;
use AppBundle\Form\Filter\Admin\Assignments\BrandCategoryAssignmentFilterType;
use AppBundle\Manager\Entity\Common\Assignments\BrandCategoryAssignmentManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class BrandCategoryAssignmentController extends AssignmentController {
	
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
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptions() {
		$options = parent::getFilterFormOptions();
		
		$this->addEntityChoicesFormOption($options, Brand::class, 'brands');
		$this->addEntityChoicesFormOption($options, Category::class, 'categories');
		
		return $options;
	}

	protected function getEditorFormOptions() {
		$options = parent::getEditorFormOptions();
		
		$this->addEntityChoicesFormOption($options, Brand::class, 'brand');
		$this->addEntityChoicesFormOption($options, Category::class, 'category');
		
		return $options;
	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(BrandCategoryAssignmentManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new BrandCategoryAssignmentFilter());
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return BrandCategoryAssignment::class;
	}

	protected function getEditorFormType() {
		return BrandCategoryAssignmentEditorType::class;
	}

	protected function getFilterFormType() {
		return BrandCategoryAssignmentFilterType::class;
	}
}