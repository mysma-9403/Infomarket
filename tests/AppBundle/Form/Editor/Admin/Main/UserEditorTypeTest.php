<?php

namespace Tests\AppBundle\Form\Editor\Admin\Main;

use AppBundle\Entity\Main\User;
use AppBundle\Form\Editor\Admin\Main\UserEditorType;
use Tests\AppBundle\Form\Editor\Admin\Base\BaseEditorTypeTest;

class UserEditorTypeTest extends BaseEditorTypeTest {

	const USERNAME = 'Test username';

	const FORENAME = 'Test forename';

	const SURNAME = 'Test surname';

	const PSEUDONYM = 'Test pseudonym';

	const EMAIL = 'test@krk-dev.com';

	const ROLES = [self::ROLE_1, self::ROLE_2];

	const ROLE_1 = 'ROLE_USER';

	const ROLE_2 = 'ROLE_ADMIN';

	const ROLE_CHOICES = ['User role' => self::ROLE_1, 'Admin role' => self::ROLE_2];

	protected function assertEntity($entity) {
		parent::assertEntity($entity);
		
		/** @var User $entity */
		$this->assertSame(self::USERNAME, $entity->getUsername());
		$this->assertSame(self::FORENAME, $entity->getForename());
		$this->assertSame(self::SURNAME, $entity->getSurname());
		$this->assertSame(self::PSEUDONYM, $entity->getPseudonym());
		$this->assertSame(self::EMAIL, $entity->getEmail());
		
		$this->assertSameSize(self::ROLES, $entity->getRoles());
		foreach (self::ROLES as $item) {
			$this->assertContains($item, $entity->getRoles());
		}
	}

	protected function getFormData() {
		$data = parent::getFormData();
		
		$data['username'] = self::USERNAME;
		$data['forename'] = self::FORENAME;
		$data['surname'] = self::SURNAME;
		$data['pseudonym'] = self::PSEUDONYM;
		$data['email'] = self::EMAIL;
		$data['roles'] = self::ROLES;
		
		return $data;
	}

	protected function getFormOptions() {
		$options = parent::getFormOptions();
		
		$options[self::getChoicesName('roles')] = self::ROLE_CHOICES;
		
		return $options;
	}

	protected function getFormType() {
		return UserEditorType::class;
	}

	protected function getEntity() {
		return new User();
	}
}