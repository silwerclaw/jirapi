<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 10:27
 */

namespace Silwerclaw\Jirapi\Services;
use Silwerclaw\Jirapi\Collections\Collection;
use Silwerclaw\Jirapi\Entities\Issue;
use Silwerclaw\Jirapi\Entities\Sprint;
use Silwerclaw\Jirapi\Exceptions\Exception;
use Silwerclaw\Jirapi\Validators\SprintValidator;

/**
 * Class SprintService
 * @package Silwerclaw\Jirapi\Services
 */
class SprintService extends Service
{

    /**
     * @var array
     */
    protected $endpoints = [
        'get'         => '/rest/agile/1.0/sprint/{sprintId}',
        'create'      => '/rest/agile/1.0/sprint',
        'getIssues'   => '/rest/agile/1.0/board/{boardId}/sprint/{sprintId}/issue'
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
        $endpoint = str_replace('{sprintId}', $sprintId, $this->endpoints[__FUNCTION__]);
        
        $request = $this->newRequest()->setMethod('GET')->setEndpoint($endpoint);

        return new Sprint($this->sendRequest($request));
    }

    /**
     * Create new Sprint with the given $data
     *
     * @param array $data
     *
     * @throws Exception
     * @return Sprint
     */
    public function create(array $data)
    {
        $validator = new SprintValidator($data);
        
        if ($validator->validate()) {

            $request = $this->newRequest()
                ->setMethod('POST')
                ->setEndpoint($this->endpoints[__FUNCTION__])
                ->setParams($data);

            return new Sprint($this->sendRequest($request));
        }

        return null;
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

    /**
     * Get all issues you have access to that belong to the sprint from the board.
     * Issue returned from this resource contains additional fields like: sprint, closedSprints, flagged and epic.
     * Issues are returned ordered by rank. JQL order has higher priority than default rank.
     *
     * @param int $boardId
     * @param int $sprintId
     *
     * @return Collection
     */
    public function getIssues(int $boardId, int $sprintId)
    {
        $request = $this->newRequest()
            ->setMethod('GET')
            ->setEndpoint(str_replace(['{boardId}', '{sprintId}'], [$boardId, $sprintId], $this->endpoints[__FUNCTION__]));

        $response = $this->sendRequest($request);

        return new Collection($this->transformValues($response['issues'], Issue::class));
    }


}