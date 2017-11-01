<?php

namespace AppBundle\Repository\Logic\ProductNote;

interface DependentItemsRepository {
	
	function createFrom(array $items);
}