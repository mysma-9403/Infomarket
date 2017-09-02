<?php

namespace AppBundle\Manager\Utils;

class AssignmentsManager {

	const DEFAULT_ITEM_KEY = 'id';

	/**
	 *
	 * @var string
	 */
	protected $itemType;

	/**
	 *
	 * @var string
	 */
	protected $assigneeType;

	/**
	 *
	 * @var string
	 */
	protected $itemKey;

	/**
	 *
	 * @var string
	 */
	protected $assigneeKey;

	public function __construct($itemType, $assigneeType) {
		$this->itemType = $itemType;
		$this->assigneeType = $assigneeType;
		
		$this->itemKey = self::DEFAULT_ITEM_KEY;
		$this->assigneeKey = $this->itemType;
	}

	public function setItemKey($key) {
		$this->itemKey = $key;
		
		return $this;
	}

	public function setAssigneeKey($key) {
		$this->assigneeKey = $key;
		
		return $this;
	}

	/**
	 * Assigns entries from $assignees to matching entries from $items.
	 * Assignee matches item, if their key fields have the same value
	 * (e.g. item.id = assignee.item).
	 *
	 * @param array $items        	
	 * @param array $assignees        	
	 *
	 * @return array items with assigned values
	 *        
	 * @see AssignmentsManager.setItemKey
	 * @see AssignmentsManager.setAssigneeKey
	 */
	public function assignToItems($items, array $assignees) {
		$size = count($items);
		for ($i = 0; $i < $size; $i ++) {
			$items[$i] = $this->assignToItem($items[$i], $assignees);
		}
		
		return $items;
	}

	/**
	 * Assigns matching entries from $assignees to the $item entry.
	 * Assignee matches item, if their key fields have the same value
	 * (e.g. item.id = assignee.item).
	 *
	 * @param
	 *        	$item
	 * @param array $assignees        	
	 *
	 * @return array items with assigned values
	 *        
	 * @see AssignmentsManager.setItemKey
	 * @see AssignmentsManager.setAssigneeKey
	 */
	public function assignToItem($item, array $assignees) {
		$itemAssignments = array ();
		foreach ($assignees as $assignee) {
			if ($assignee[$this->assigneeKey] == $item[$this->itemKey]) {
				$itemAssignments[] = $assignee;
			}
		}
		$item[$this->assigneeType] = $itemAssignments;
		
		return $item;
	}
}