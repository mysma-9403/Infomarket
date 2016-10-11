<?php

namespace AppBundle\Manager\Filter\Common;

use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use AppBundle\Entity\Filter\ProductCategoryAssignmentFilter;
use AppBundle\Entity\User;
use AppBundle\Manager\Filter\Base\BaseFilterManager;
use AppBundle\Entity\Segment;

class ProductCategoryAssignmentFilterManager extends BaseFilterManager {
	
	protected function create() {
		$userRepository = $this->doctrine->getRepository(User::class);
		$productRepository = $this->doctrine->getRepository(Product::class);
		$categoryRepository = $this->doctrine->getRepository(Category::class);
		$segmentRepository = $this->doctrine->getRepository(Segment::class);
	
		return new ProductCategoryAssignmentFilter($userRepository, $productRepository, $categoryRepository, $segmentRepository);
	}
}