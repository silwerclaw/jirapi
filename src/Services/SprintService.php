<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 10:27
 */

namespace Silwerclaw\Jirapi\Services;
use Silwerclaw\Jirapi\Entities\Sprint;
use Silwerclaw\Jirapi\Request;

/**
 * Class SprintService
 * @package Silwerclaw\Jirapi\Services
 */
class SprintService
{

    protected $endpoints = [
        'get' => '/rest/agile/1.0/sprint/{sprintId}'
    ];

    /**
     * Read data about the Sprint where ID=$sprintId
     *
     * @param int $sprintId
     * 
     * @return Sprint
     */
    public function get(int $sprintId)
    {
        $request = new Request();
        $endpoint = str_replace('{sprintId}', $sprintId, $this->endpoints['get']);

        return $request->setMethod('GET')->setEndpoint($endpoint)->doRequest();
    }

    /**
     * Create new Sprint with the given $data
     *
     * @param array $data
     */
    public function create(array $data)
    {

    }

    /**
     * Update Sprint where ID=$sprintId with $data attributes.
     * Partial update means that properties you did not mentioned will not be updated
     *
     * @param int $sprintId
     * @param array $data
     * @param bool $partially
     */
    public function update(int $sprintId, array $data, bool $partially = false)
    {

    }

    /**
     * Delete Sprint with the given $sprintId
     *
     * @param $sprintId
     */
    public function delete($sprintId)
    {

    }

    /**
     * Swap the position of Sprint where ID=$sprintId with Sprint where ID=$sprintIdToSwapWith
     *
     * @param int $sprintId
     * @param int $sprintIdToSwapWith
     */
    public function swap(int $sprintId, int $sprintIdToSwapWith)
    {

    }


}