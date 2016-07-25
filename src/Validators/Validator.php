<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 23:43
 */

namespace Silwerclaw\Jirapi\Validators;


use Silwerclaw\Jirapi\Exceptions\ValidationException;

/**
 * Class Validator
 * @package Silwerclaw\Jirapi\Validators
 */
class Validator
{

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var string
     */
    protected $message;

    /**
     * SprintValidator constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getErrors() : array
    {
        return $this->errors;
    }

    /**
     * @return bool
     * @throws ValidationException
     */
    public function validate() : bool
    {
        $valid = true;
        
        foreach ($this->rules as $rule) {
            if ($this->{$rule}()) {
                $valid = false;
                
                if ($this->message) {
                    $this->errors[] = $this->message;
                    $this->message = null;
                }
            }
        }

        if (!$valid) {
            throw new ValidationException($this->errors);
        }
        
        return $valid;
    }

}