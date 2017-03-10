<?php
namespace Booya\Validator;

use Booya\Exception\InvalidFieldException;
use Mouf\Database\TDBM\TDBMService;

/**
 * Class TDBMUniqueConstraintValidator
 * @package Booya\Validator
 */
class TDBMUniqueConstraintValidator extends AbstractValidator
{
    /** @var TDBMService */
    private $tdbmService;

    /** @var string */
    private $table;

    /** @var array<string, mixed> */
    private $uniqueConstraints;

    /**
     * TDBMUniqueConstraintValidator constructor.
     * @param $tdbmService
     * @param array $uniqueConstraints
     */
    public function __construct(TDBMService $tdbmService, string $table, array $uniqueConstraints, $errorMessage = "")
    {
        parent::__construct($errorMessage);
        $this->tdbmService = $tdbmService;
        $this->table = $table;
        $this->uniqueConstraints = $uniqueConstraints;
    }

    /**
     * @param mixed $value
     * @param $contextObject
     *
     * @throws InvalidFieldException
     */
    public function validate($value, $contextObject = null)
    {

    }
}