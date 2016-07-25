<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 23:49
 */

namespace Silwerclaw\Jirapi\Exceptions;

/**
 * Class MultipleException
 * @package Silwerclaw\Jirapi\Exceptions
 */
class MultipleException extends Exception
{

    /**
     * @var Exception[]
     */
    protected $exceptions;

    /**
     * MultipleException constructor.
     * @param Exception[] $exceptions
     */
    public function __construct(array $exceptions)
    {
        $this->exceptions = array_map(function($exception) {
            return $exception instanceof Exception ? $exception : new Exception($exception);
        }, $exceptions);
    }

    /**
     * @return Exception[]
     */
    public function getExceptions()
    {
        return $this->exceptions;
    }
    
}