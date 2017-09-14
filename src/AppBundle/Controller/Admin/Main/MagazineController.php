<?php

namespace AppBundle\Controller\Admin\Main;

use AppBundle\Controller\Admin\Base\FeaturedController;
use AppBundle\Entity\Main\Branch;
use AppBundle\Entity\Main\Category;
use AppBundle\Entity\Main\Magazine;
use AppBundle\Factory\Common\Choices\Bool\FeaturedChoicesFactory;
use AppBundle\Factory\Common\Choices\Bool\InfomarketChoicesFactory;
use AppBundle\Factory\Common\Choices\Bool\InfoproduktChoicesFactory;
use AppBundle\Filter\Common\Main\MagazineFilter;
use AppBundle\Form\Editor\Admin\Main\MagazineEditorType;
use AppBundle\Form\Filter\Admin\Main\MagazineFilterType;
use AppBundle\Form\Lists\Base\FeaturedListType;
use AppBundle\Manager\Entity\Common\Main\MagazineManager;
use AppBundle\Manager\Filter\Base\FilterManager;
use Symfony\Component\HttpFoundation\Request;

class MagazineController extends FeaturedController {
	
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

	/**
	 *
	 * @param Request $request        	
	 * @param integer $id        	
	 *
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function setFeaturedAction(Request $request, $id) {
		return $this->setFeaturedActionInternal($request, $id);
	}
	
	// ---------------------------------------------------------------------------
	// Form options
	// ---------------------------------------------------------------------------
	protected function getFilterFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.filter.main.magazine');
	}
	
	protected function getEditorFormOptionsProvider() {
		return $this->get('app.misc.provider.form_options.editor.main.magazine');
	}
	
	// ---------------------------------------------------------------------------
	// Internal logic
	// ---------------------------------------------------------------------------
	protected function getListItemsProvider() {
		return $this->get('app.misc.provider.name_list_items_provider');
	}
	
// 	protected function getFilterFormOptions() {
// 		$options = parent::getFilterFormOptions();
		
// 		$this->addEntityChoicesFormOption($options, Magazine::class, 'parents');
// 		$this->addEntityChoicesFormOption($options, Branch::class, 'branches');
// 		$this->addEntityChoicesFormOption($options, Category::class, 'categories');
		
// 		$this->addFactoryChoicesFormOption($options, InfomarketChoicesFactory::class, 'infomarket');
// 		$this->addFactoryChoicesFormOption($options, InfoproduktChoicesFactory::class, 'infoprodukt');
// 		$this->addFactoryChoicesFormOption($options, FeaturedChoicesFactory::class, 'featured');
		
// 		return $options;
// 	}

// 	protected function getEditorFormOptions() {
// 		$options = parent::getEditorFormOptions();
		
// 		$this->addEntityChoicesFormOption($options, Magazine::class, 'parent');
		
// 		return $options;
// 	}
	
	// ---------------------------------------------------------------------------
	// Managers
	// ---------------------------------------------------------------------------
	protected function getEntityManager($doctrine, $paginator) {
		return $this->get(MagazineManager::class);
	}

	protected function getFilterManager($doctrine) {
		return new FilterManager(new MagazineFilter());
	}
	
	// ------------------------------------------------------------------------
	// EntityType related
	// ------------------------------------------------------------------------
	protected function getEntityType() {
		return Magazine::class;
	}
	
	// ------------------------------------------------------------------------
	// Forms
	// ------------------------------------------------------------------------
	protected function getEditorFormType() {
		return MagazineEditorType::class;
	}

	protected function getFilterFormType() {
		return MagazineFilterType::class;
	}

	protected function getListFormType() {
		return FeaturedListType::class;
	}
}