<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 15:23
 */

namespace Silwerclaw\Jirapi\Entities;

/**
 * Class Board
 * @package Silwerclaw\Jirapi\Entities
 */
class Board extends Entity
{

    const KANBAN_TYPE = 'kanban';
    
    const SCRUM_TYPE = 'scrum';
    
    protected $service = 'Board';

}