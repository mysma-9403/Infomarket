<?php

namespace AppBundle\Form\Filter\Base;

use AppBundle\Entity\Filter\Base\BaseEntityFilter;
use AppBundle\Entity\User;
use AppBundle\Form\Base\FilterType;
use AppBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;

class BaseEntityFilterType extends FilterType
{
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::addMainFields()
	 */
	protected function addMainFields(FormBuilderInterface $builder, array $options) {
	
		$builder
		->add('updatedAfter', DateTimeType::class, array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy HH:mm',
				'required' => false,
				'attr' => [
						'class' => 'form-control input-inline datetimepicker',
						'data-provide' => 'datetimepicker',
						'data-date-format' => 'DD/MM/YYYY HH:mm',
						'placeholder' => 'label.updatedAfter'
				]
		))
		->add('updatedBefore', DateTimeType::class, array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy HH:mm',
				'required' => false,
				'attr' => [
						'class' => 'form-control input-inline datetimepicker',
						'data-provide' => 'datepicker',
						'data-date-format' => 'DD/MM/YYYY HH:mm',
						'placeholder' => 'label.updatedBefore'
				]
		))
		->add('createdAfter', DateTimeType::class, array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy HH:mm',
				'required' => false,
				'attr' => [
						'class' => 'form-control input-inline datetimepicker',
						'data-provide' => 'datepicker',
						'data-date-format' => 'DD/MM/YYYY HH:mm',
						'placeholder' => 'label.createdAfter'
				]
		))
		->add('createdBefore', DateTimeType::class, array(
				'widget' => 'single_text',
				'format' => 'dd/MM/yyyy HH:mm',
				'required' => false,
				'attr' => [
						'class' => 'form-control input-inline datetimepicker',
						'data-provide' => 'datepicker',
						'data-date-format' => 'DD/MM/YYYY HH:mm',
						'placeholder' => 'label.createdBefore'
				]
		))
		->add('updatedBy', EntityType::class, array(
				'class'			=> User::class,
				'query_builder' => function (UserRepository $repository) {
				return $repository->createQueryBuilder('e')
				->orderBy('e.surname ASC, e.forename', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.user'
		))
		->add('createdBy', EntityType::class, array(
				'class'			=> User::class,
				'query_builder' => function (UserRepository $repository) {
				return $repository->createQueryBuilder('e')
				->orderBy('e.surname ASC, e.forename', 'ASC');
				},
				'required'		=> false,
				'expanded'      => false,
				'multiple'      => true,
				'placeholder'	=> 'label.choose.user'
		))
		;
	}
	
	/**
	 *
	 * {@inheritDoc}
	 * @see \AppBundle\Form\Base\FormType::getEntityType()
	 */
	protected function getEntityType() {
		return BaseEntityFilter::class;
	}
}