<?php

namespace AppBundle\Manager\Analytics;

class AnalyticsManager {

	protected $tracker;

	protected $version;

	public function __construct($tracker, $version) {
		$this->tracker = $tracker;
		$this->version = $version;
	}

	public function sendPageviewAnalytics($domain, $route) {
		$data = array ('v' => $this->version,'t' => 'pageview','dh' => $domain,'dp' => $route 
		);
		
		$this->tracker->send($data, 'pageview');
	}

	public function sendEventAnalytics($entry, $action, $id) {
		$data = array ('v' => $this->version,'t' => 'event','ec' => $entry,'ea' => $action,'el' => 'id',
				'ev' => $id 
		);
		
		$this->tracker->send($data, 'event');
	}
}