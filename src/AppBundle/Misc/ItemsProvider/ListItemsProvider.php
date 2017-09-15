<?php

namespace AppBundle\Misc\ItemsProvider;

class ListItemsProvider implements ItemsProvider {

	public function getItems(array $params) {
		$viewParams = $params['viewParams'];
		$litItems = $viewParams['listItems'];
		return $litItems;
	}
}