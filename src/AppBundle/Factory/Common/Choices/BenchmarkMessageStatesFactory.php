<?php

namespace AppBundle\Factory\Common\Choices;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Factory\Common\Choices\Base\AbstractChoicesFactory;

class BenchmarkMessageStatesFactory extends AbstractChoicesFactory {
	/**
	 * {@inheritDoc}
	 * @see \AppBundle\Factory\Common\Choices\ChoicesFactory::getItems()
	 */
	public function getItems() {
		return [
				//TODO DI
				BenchmarkMessage::getStateName(BenchmarkMessage::IN_PROCESS_STATE) => BenchmarkMessage::IN_PROCESS_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::INFORMATION_REQUIRED_STATE) => BenchmarkMessage::INFORMATION_REQUIRED_STATE,
				BenchmarkMessage::getStateName(BenchmarkMessage::COMPLETED_STATE) => BenchmarkMessage::COMPLETED_STATE
		];
	}
	
}