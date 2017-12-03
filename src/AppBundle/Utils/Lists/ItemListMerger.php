<?php

namespace AppBundle\Utils\Lists;

class ItemListMerger implements ListMerger {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see \AppBundle\Utils\Lists\ListMerger::merge()
	 */
	public function merge(array $list1, array $list2) {
		$result = $list1;
		foreach ($list2 as $item) {
			if (! $this->contains($result, $item)) {
				$result[] = $item;
			}
		}
		
		return $result;
	}

	private function contains(array $list, array $needle) {
		foreach ($list as $item) {
			if ($item['id'] === $needle['id']) {
				return true;
			}
		}
		
		return false;
	}
}