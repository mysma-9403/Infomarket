<?php

namespace AppBundle\Controller\Admin\Base;

abstract class AssignmentController extends BaseController {
	
	// ---------------------------------------------------------------------------
	// Roles
	// ---------------------------------------------------------------------------
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
	}
}