<?php

namespace AppBundle\Form\FormBuilder;

use AppBundle\Entity\Main\BenchmarkField;
use AppBundle\Form\Transformer\NumberToBooleanTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class BenchmarkEditorFieldBuilder implements FormBuilder {

	/**
	 *
	 * @var NumberToBooleanTransformer
	 */
	protected $int2boolTransformer;

	public function __construct(NumberToBooleanTransformer $int2boolTransformer) {
		$this->int2boolTransformer = $int2boolTransformer;
	}

	public function add(FormBuilderInterface &$builder, array $params, $options = []) {
		$valueField = $params['valueField'];
		$fieldName = $params['fieldName'];
		$fieldType = $params['fieldType'];
		
		switch ($fieldType) {
			case BenchmarkField::DECIMAL_FIELD_TYPE:
				$builder->add($valueField, NumberType::class, 
						array('attr' => ['placeholder' => $fieldName], 'required' => false));
				break;
			case BenchmarkField::INTEGER_FIELD_TYPE:
				$builder->add($valueField, IntegerType::class, 
						array('attr' => ['placeholder' => $fieldName], 'required' => false));
				break;
			case BenchmarkField::BOOLEAN_FIELD_TYPE:
				$builder->add($valueField, CheckboxType::class, array('required' => false));
				
				$builder->get($valueField)->addModelTransformer($this->int2boolTransformer);
				break;
			default:
				$builder->add($valueField, null, 
						array('attr' => ['placeholder' => $fieldName], 'required' => false));
				break;
		}
	}
}