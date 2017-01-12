<?php

namespace AppBundle\Entity\Filter;

use AppBundle\Entity\Filter\Base\SimpleEntityFilter;
use AppBundle;
use AppBundle\Entity\MenuEntry;
use AppBundle\Repository\MenuEntryRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\MenuRepository;
use AppBundle\Entity\Menu;

class MenuMenuEntryAssignmentFilter extends SimpleEntityFilter {
	
	/**
	 * 
	 * @param UserRepository $userRepository
	 * @param MenuEntryRepository $menuEntryRepository
	 */
	public function __construct(UserRepository $userRepository, MenuEntryRepository $menuEntryRepository, MenuRepository $menuRepository) {
		parent::__construct($userRepository);
		
		$this->menuEntryRepository = $menuEntryRepository;
		$this->menuRepository = $menuRepository;
		
		$this->filterName = 'menu_menu_entry_assignment_filter_';
		
		$this->orderBy = 'm.name ASC, me.treePath ASC';
	}
	
	/**
	 * @var MenuEntryRepository
	 */
	protected $menuEntryRepository;
	
	/**
	 * @var MenuRepository
	 */
	protected $menuRepository;
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::initMoreValues()
	 */
	protected function initMoreValues(Request $request) {
		parent::initMoreValues($request);
	
		$menuEntries = $request->get($this->getFilterName() . 'menu_entries', array());
		$this->menuEntries = $this->menuEntryRepository->findBy(array('id' => $menuEntries));
		
		$menus = $request->get($this->getFilterName() . 'menus', array());
		$this->menu = $this->menuRepository->findBy(array('id' => $menus));
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::clearMoreQueryValues()
	 */
	protected function clearMoreQueryValues() {
		parent::clearMoreQueryValues();
	
		$this->menuEntries = array();
		$this->menus = array();
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\SimpleEntityFilter::getValues()
	 */
	public function getValues() {
		$values = parent::getValues();
	
		if($this->menuEntries) {
			$values[$this->getFilterName() . 'menuEntries'] = $this->getIdValues($this->menuEntries);
		}
		
		if($this->menus) {
			$values[$this->getFilterName() . 'menus'] = $this->getIdValues($this->menus);
		}
		
		return $values;
	}
	
	protected function getWhereExpressions() {
		$expressions = parent::getWhereExpressions();
		
		if($this->menuEntries) {
			$expressions[] = $this->getEqualArrayExpression('e.menuEntry', $this->menuEntries);
		}
		
		if($this->menus) {
			$expressions[] = $this->getEqualArrayExpression('e.menu', $this->menus);
		}
		
		return $expressions;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Entity\Filter\Base\BaseEntityFilter::getJoinExpressions()
	 */
	protected function getJoinExpressions() {
		$expressions = parent::getJoinExpressions();
		
		$expressions[] = MenuEntry::class . ' me WITH e.menuEntry = me.id';
		
		$expressions[] = Menu::class . ' m WITH e.menu = m.id';
	
		return $expressions;
	}
	
	/**
	 *
	 * @var array
	 */
	private $menuEntries;
	
	/**
	 *
	 * @var array
	 */
	private $menus;
	
	/**
	 * Set menuEntries
	 *
	 * @param array $menuEntries
	 *
	 * @return MenuMenuEntryAssignmentFilter
	 */
	public function setMenuEntries($menuEntries)
	{
		$this->menuEntries = $menuEntries;
	
		return $this;
	}
	
	/**
	 * Get menuEntries
	 *
	 * @return array
	 */
	public function getMenuEntries()
	{
		return $this->menuEntries;
	}
	
	/**
	 * Set menus
	 *
	 * @param array $menus
	 *
	 * @return MenuMenuEntryAssignmentFilter
	 */
	public function setMenus($menus)
	{
		$this->menus = $menus;
	
		return $this;
	}
	
	/**
	 * Get menus
	 *
	 * @return array
	 */
	public function getMenus()
	{
		return $this->menus;
	}
}