<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 24.07.16
 * Time: 12:48
 */

namespace Silwerclaw\Jirapi\Validators;


use Silwerclaw\Jirapi\Entities\Board;

/**
 * Class BoardValidator
 * @package Silwerclaw\Jirapi\Validators
 */
class BoardValidator extends Validator
{

    /**
     * Rules to check for validated data
     *
     * @var array
     */
    protected $rules = [
        'validateTypeRequired',
        'validateTypeValue',
        'validateFilterIdRequired',
        'validateNameRequired',
        'validateNameLength',
    ];

    protected function validateTypeRequired()
    {
        $this->message = '"type" field is required';

        return isset($this->data['type']) && $this->data['type'];
    }

    protected function validateTypeValue()
    {
        if (isset($this->data['type'])) {
            $validValues = [Board::KANBAN_TYPE, Board::SCRUM_TYPE];

            $this->message = '"type" field value can be only one of [' . implode(',', $validValues) . ']';

            return in_array($this->data['type'], $validValues);
        }

        return true;
    }

    protected function validateFilterIdRequired()
    {
        $this->message = '"filterId" field is required';

        return isset($this->data['filterId']) && $this->data['filterId'];
    }

    protected function validateNameRequired()
    {
        $this->message = '"name" field is required';

        return isset($this->data['name']) && !empty(trim($this->data['name']));
    }

    protected function validateNameLength()
    {
        if (isset($this->data['name'])) {
            $this->message = '"name" field must be less than 255 characters';

            return strlen($this->data['name']) < 255;
        }
        
        return true;
    }

}