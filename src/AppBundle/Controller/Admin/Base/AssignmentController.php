<?php

namespace AppBundle\Controller\Admin\Base;



abstract class AssignmentController extends BaseEntityController {
	
	//---------------------------------------------------------------------------
	// Roles
	//---------------------------------------------------------------------------
	
	protected function getDeleteRole() {
		return 'ROLE_EDITOR';
	}
}