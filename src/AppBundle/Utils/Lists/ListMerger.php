<?php

namespace AppBundle\Utils\Lists;

interface ListMerger {
	
	function merge(array $list1, array $list2);
}