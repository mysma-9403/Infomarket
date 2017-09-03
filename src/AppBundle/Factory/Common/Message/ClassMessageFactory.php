<?php

namespace AppBundle\Factory\Common\Message;

interface ClassMessageFactory {

	const TYPE = '%type%';

	function getMessage($messageLabel, $type, $params);
}