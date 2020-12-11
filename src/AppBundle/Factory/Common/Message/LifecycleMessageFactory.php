<?php

namespace AppBundle\Factory\Common\Message;

use AppBundle\Utils\ClassUtils;
use AppBundle\Utils\LabelUtils;
use Symfony\Component\Translation\TranslatorInterface;

class LifecycleMessageFactory implements ClassMessageFactory {

	const PRE_B = '<b>';

	const POST_B = '</b>';

	/**
	 *
	 * @var TranslatorInterface
	 */
	protected $translator;

	public function __construct(TranslatorInterface $translator) {
		$this->translator = $translator;
	}

	public function getMessage($messageLabel, $type, $params = []) {
		$message = $this->translator->trans($messageLabel);
		
		$typeName = ClassUtils::getParamCaseName($type);
		$typeLabel = LabelUtils::getLabel($typeName);
		$typeParam = $this->translator->trans($typeLabel);
		
		return $this->replaceParam($message, self::TYPE, $typeParam);
	}

	protected function replaceParam($message, $paramName, $param) {
		return str_replace($paramName, self::PRE_B . $param . self::POST_B, $message);
	}
}