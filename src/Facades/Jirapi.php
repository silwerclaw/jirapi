<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 04.08.16
 * Time: 18:10
 */

namespace Silwerclaw\Jirapi\Facades;


use Illuminate\Support\Facades\Facade;

class Jirapi extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Silwerclaw\Jirapi\Jirapi::class;
    }

}