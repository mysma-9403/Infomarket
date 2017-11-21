<?php

namespace AppBundle\Factory\Common\BenchmarkField;

use AppBundle\Entity\Main\BenchmarkField;

interface BenchmarkFieldFactory {

	public function create(BenchmarkField $field);
}