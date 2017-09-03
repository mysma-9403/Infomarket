<?php

namespace AppBundle\Entity\Main;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser {

	const ROLE_EDITOR = 'ROLE_EDITOR';

	const ROLE_RATING_EDITOR = 'ROLE_RATING_EDITOR';

	const ROLE_PUBLISHER = 'ROLE_PUBLISHER';

	const ROLE_ADMIN = 'ROLE_ADMIN';

	public function getDisplayName() {
		if ($this->pseudonym != null) {
			return $this->pseudonym;
		}
		if ($this->surname != null) {
			return $this->surname . ' ' . $this->forename;
		}
		return $this->username;
	}

	public function __toString() {
		return $this->getDisplayName();
	}

	/**
	 *
	 * @var string
	 */
	private $forename;

	/**
	 *
	 * @var string
	 */
	private $surname;

	/**
	 *
	 * @var string
	 */
	private $pseudonym;

	/**
	 *
	 * @var string
	 */
	private $street;

	/**
	 *
	 * @var string
	 */
	private $city;

	/**
	 *
	 * @var string
	 */
	private $zipCode;

	/**
	 *
	 * @var boolean
	 */
	private $digitalSubscription;

	/**
	 *
	 * @var boolean
	 */
	private $physicalSubscription;

	/**
	 *
	 * @var boolean
	 */
	private $dataProcessingAgreement;

	/**
	 *
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $userCategoryAssignments;

	/**
	 * Set forename
	 *
	 * @param string $forename        	
	 *
	 * @return User
	 */
	public function setForename($forename) {
		$this->forename = $forename;
		
		return $this;
	}

	/**
	 * Get forename
	 *
	 * @return string
	 */
	public function getForename() {
		return $this->forename;
	}

	/**
	 * Set surname
	 *
	 * @param string $surname        	
	 *
	 * @return User
	 */
	public function setSurname($surname) {
		$this->surname = $surname;
		
		return $this;
	}

	/**
	 * Get surname
	 *
	 * @return string
	 */
	public function getSurname() {
		return $this->surname;
	}

	/**
	 * Set pseudonym
	 *
	 * @param string $pseudonym        	
	 *
	 * @return User
	 */
	public function setPseudonym($pseudonym) {
		$this->pseudonym = $pseudonym;
		
		return $this;
	}

	/**
	 * Get pseudonym
	 *
	 * @return string
	 */
	public function getPseudonym() {
		return $this->pseudonym;
	}

	/**
	 * Set street
	 *
	 * @param string $street        	
	 *
	 * @return User
	 */
	public function setStreet($street) {
		$this->street = $street;
		
		return $this;
	}

	/**
	 * Get street
	 *
	 * @return string
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Set city
	 *
	 * @param string $city        	
	 *
	 * @return User
	 */
	public function setCity($city) {
		$this->city = $city;
		
		return $this;
	}

	/**
	 * Get city
	 *
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Set zipCode
	 *
	 * @param string $zipCode        	
	 *
	 * @return User
	 */
	public function setZipCode($zipCode) {
		$this->zipCode = $zipCode;
		
		return $this;
	}

	/**
	 * Get zipCode
	 *
	 * @return string
	 */
	public function getZipCode() {
		return $this->zipCode;
	}

	/**
	 * Set digitalSubscription
	 *
	 * @param boolean $digitalSubscription        	
	 *
	 * @return User
	 */
	public function setDigitalSubscription($digitalSubscription) {
		$this->digitalSubscription = $digitalSubscription;
		
		return $this;
	}

	/**
	 * Get digitalSubscription
	 *
	 * @return boolean
	 */
	public function getDigitalSubscription() {
		return $this->digitalSubscription;
	}

	/**
	 * Set physicalSubscription
	 *
	 * @param boolean $physicalSubscription        	
	 *
	 * @return User
	 */
	public function setPhysicalSubscription($physicalSubscription) {
		$this->physicalSubscription = $physicalSubscription;
		
		return $this;
	}

	/**
	 * Get physicalSubscription
	 *
	 * @return boolean
	 */
	public function getPhysicalSubscription() {
		return $this->physicalSubscription;
	}

	/**
	 * Set dataProcessingAgreement
	 *
	 * @param boolean $dataProcessingAgreement        	
	 *
	 * @return User
	 */
	public function setDataProcessingAgreement($dataProcessingAgreement) {
		$this->dataProcessingAgreement = $dataProcessingAgreement;
		
		return $this;
	}

	/**
	 * Get dataProcessingAgreement
	 *
	 * @return boolean
	 */
	public function getDataProcessingAgreement() {
		return $this->dataProcessingAgreement;
	}

	/**
	 * Add userCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment        	
	 *
	 * @return User
	 */
	public function addUserCategoryAssignment(
			\AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment) {
		$this->userCategoryAssignments[] = $userCategoryAssignment;
		
		return $this;
	}

	/**
	 * Remove userCategoryAssignment
	 *
	 * @param \AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment        	
	 */
	public function removeUserCategoryAssignment(
			\AppBundle\Entity\Assignments\UserCategoryAssignment $userCategoryAssignment) {
		$this->userCategoryAssignments->removeElement($userCategoryAssignment);
	}

	/**
	 * Get userCategoryAssignments
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getUserCategoryAssignments() {
		return $this->userCategoryAssignments;
	}
}
