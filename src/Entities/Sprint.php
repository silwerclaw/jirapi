<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 15:24
 */

namespace Silwerclaw\Jirapi\Entities;
use Carbon\Carbon;
use Silwerclaw\Jirapi\Jirapi;

/**
 * Class Sprint
 * @package Silwerclaw\Jirapi\Entities
 */
class Sprint extends Entity
{

    /** Relations [start] */

    /** Relations [end] */
    
    /** Mutators [start] */
    
    public function getStartDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getEndDateAttribute($value)
    {
        return Carbon::parse($value);
    }
    
    /** Mutators [end] */

    /**
     * Get sprint object by id
     *
     * @param int $sprintId
     *
     * @return Sprint
     */
    public static function find(int $sprintId)
    {
        return app()->make(Jirapi::class)->getService('Sprint')->get($sprintId);
    }

}