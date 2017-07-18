<?php

namespace AppBundle\Factory\Common\Choices\Enum;

use AppBundle\Entity\BenchmarkMessage;
use AppBundle\Factory\Common\Choices\Base\TwigChoicesFactory;

class BenchmarkMessageStatesFactory extends TwigChoicesFactory {
	
	public function __construct() {
		$this->items['label.benchmarkMessage.state.reported'] = BenchmarkMessage::REPORTED_STATE;
		$this->items['label.benchmarkMessage.state.inProcess'] = BenchmarkMessage::IN_PROCESS_STATE;
		$this->items['label.benchmarkMessage.state.informationRequired'] = BenchmarkMessage::INFORMATION_REQUIRED_STATE;
		$this->items['label.benchmarkMessage.state.informationSupplied'] = BenchmarkMessage::INFORMATION_SUPPLIED_STATE;
		$this->items['label.benchmarkMessage.state.completed'] = BenchmarkMessage::COMPLETED_STATE;
	}
	
	protected function getTwigFunctionName() {
		return 'benchmarkMessageStateName';
	}
}