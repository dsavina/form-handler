<?php
namespace Booya\Validator;

use Booya\Exception\InvalidFieldException;
use Mouf\Utils\Value\ValueInterface;
use Mouf\Utils\Value\ValueUtils;

/**
 * A range constraint
 *
 * Class RangeValidator
 * @package Booya\Validator
 */
class RangeValidator extends AbstractValidator
{
    /** @var ValueInterface  */
    private $min;

    /** @var ValueInterface  */
    private $max;

    /**
     * RangeValidator constructor.
     * @param ValueInterface $min
     * @param ValueInterface $max
     */
    public function __construct($min, $max, $error = "")
    {
        parent::__construct($error);
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param mixed $value
     * @param $contextObject
     *
     * @throws InvalidFieldException
     */
    public function validate($value, $contextObject = null)
    {
        $min = ValueUtils::val($this->min);
        $max = ValueUtils::val($this->max);
        if ($value < $min || $value > $max) {
            $this->throw();
        }
    }
}
