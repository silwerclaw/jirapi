<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 14:37
 */

namespace Silwerclaw\Jirapi\Services;


use Silwerclaw\Jirapi\Collections\Collection;
use Silwerclaw\Jirapi\Entities\Sprint;
use Silwerclaw\Jirapi\Request;

/**
 * Class BoardService
 * @package Silwerclaw\Jirapi\Services
 */
class BoardService extends Service
{

    protected $endpoints = [
        'getSprints' => '/rest/agile/1.0/board/{boardId}/sprint',
    ];

    public function get($boardId)
    {

    }

    /**
     * @param int $boardId
     * @param array $params
     * 
     * @return Collection
     */
    public function getSprints(int $boardId, $params = [])
    {
        $request = new Request();

        $rawData = $request
            ->setMethod('GET')
            ->setEndpoint(str_replace('{boardId}', $boardId, $this->endpoints[__FUNCTION__]))
            ->setParams($params)
            ->doRequest();

        return new Collection($this->transformValues($rawData['values'], Sprint::class));
    }

}