<?php

namespace AppBundle\Form\Transformer;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EntityToNumberTransformer implements DataTransformerInterface {

	const INVALID = - 1;

	/**
	 *
	 * @var EntityRepository
	 */
	protected $repository;

	public function __construct(EntityRepository $repository) {
		$this->repository = $repository;
	}

	/**
	 * Transforms an object (entity) to a number (id).
	 *
	 * @param mixed|null $entity        	
	 * @return integer
	 */
	public function transform($entity) {
		return $entity ? $entity->getId() : self::INVALID;
	}

	/**
	 * Transforms a number (id) to an object (entity).
	 *
	 * @param string $id        	
	 * @return mixed|null
	 * @throws TransformationFailedException if object (entity) is not found.
	 */
	public function reverseTransform($id) {
		if (! $id)
			return;
		
		$entity = $this->repository->find($id);
		
		if (null === $entity) {
			throw new TransformationFailedException(sprintf('Entity with id "%s" does not exist!', $id));
		}
		return $entity;
	}
}