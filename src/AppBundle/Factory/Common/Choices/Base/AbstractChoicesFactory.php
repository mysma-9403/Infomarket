<?php

namespace AppBundle\Factory\Common\Choices\Base;

use Symfony\Component\Translation\TranslatorInterface;

abstract class AbstractChoicesFactory implements ChoicesFactory {
	/**
	 * 
	 * @var TranslatorInterface
	 */
	protected $translator;
	
	public function __construct(TranslatorInterface $translator) {
		$this->translator = $translator;
	}
}