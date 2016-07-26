<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 26.07.16
 * Time: 9:21
 */

namespace Silwerclaw\Jirapi\Services;


class EpicService extends Service
{

    protected $endpoints = [
        'get'           => '/rest/agile/1.0/epic/{epicIdOrKey}'
    ];

    /**
     * @param $epicIdOrKey
     */
    public function get($epicIdOrKey)
    {

    }

}