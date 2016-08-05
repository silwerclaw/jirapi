<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 15:23
 */

namespace Silwerclaw\Jirapi\Entities;
use Silwerclaw\Jirapi\Jirapi;

/**
 * Class Board
 * @package Silwerclaw\Jirapi\Entities
 */
class Board extends Entity
{

    const KANBAN_TYPE = 'kanban';
    
    const SCRUM_TYPE = 'scrum';
    
    protected $service = 'Board';

    /**
     * Get board object by id
     *
     * @param int $boardId
     *
     * @return Board
     */
    public static function find(int $boardId)
    {
        return app()->make(Jirapi::class)->getService('Board')->get($boardId);
    }

}