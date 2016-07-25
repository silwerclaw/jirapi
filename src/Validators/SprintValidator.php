<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 23:39
 */

namespace Silwerclaw\Jirapi\Validators;

/**
 * Class SprintValidator
 * @package Silwerclaw\Jirapi\Validators
 */
class SprintValidator extends Validator
{

    /**
     * Rules to check for validated data
     * 
     * @var array
     */
    protected $rules = [
        'validateBoardId',
        'validateName',
    ];

    protected function validateBoardId()
    {
        $this->message = '"originBoardId" field is required';
        
        return isset($this->data['originBoardId']) && $this->data['originBoardId'];
    }

    protected function validateName()
    {
        $this->message = '"name" field is required';
        
        return isset($this->data['name']) && !empty(trim($this->data['name']));
    }

}