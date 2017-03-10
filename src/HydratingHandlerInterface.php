<?php
namespace Booya;

use Booya\Exception\HydratingException;

/**
 * An interface describing the methods needed for being used in class FieldHandler
 *
 * Interface FieldHandlerInterface
 * @package Booya
 */
interface HydratingHandlerInterface
{
    /**
     * @param array $data
     * @param array $targetData
     * @param $object
     * @return mixed
     *
     * @throws HydratingException
     */
    public function handle(array $data, array &$targetData, $object = null);
}
