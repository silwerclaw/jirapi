<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 14:37
 */

namespace Silwerclaw\Jirapi\Services;


use Silwerclaw\Jirapi\Collections\Collection;
use Silwerclaw\Jirapi\Entities\Board;
use Silwerclaw\Jirapi\Entities\Issue;
use Silwerclaw\Jirapi\Entities\Sprint;
use Silwerclaw\Jirapi\Exceptions\Exception;
use Silwerclaw\Jirapi\Validators\BoardValidator;

/**
 * Class BoardService
 * @package Silwerclaw\Jirapi\Services
 */
class BoardService extends Service
{

    protected $endpoints = [
        'get'               => '/rest/agile/1.0/board/{boardId}',
        'getAll'            => '/rest/agile/1.0/board',
        'create'            => '/rest/agile/1.0/board',
        'delete'            => '/rest/agile/1.0/board/{boardId}',
        'getBackLogIssues'  => '/rest/agile/1.0/board/{boardId}/backlog',
        'getSprints'        => '/rest/agile/1.0/board/{boardId}/sprint',
    ];

    /**
     * Returns the board for the given $boardId.
     * This board will only be returned if the user has permission to view it.
     *
     * @param int $boardId
     * 
     * @return Board
     */
    public function get(int $boardId)
    {
        $request = $this->newRequest()
            ->setMethod('GET')
            ->setEndpoint(str_replace('{boardId}', $boardId, $this->endpoints[__FUNCTION__]));
        
        return new Board($this->sendRequest($request));
    }

    /**
     * Returns all boards.
     * This only includes boards that the user has permission to view.
     *
     * @return Collection
     */
    public function getAll()
    {
        $request = $this->newRequest()
            ->setMethod('GET')
            ->setEndpoint($this->endpoints[__FUNCTION__]);

        $response = $this->sendRequest($request);

        return new Collection($this->transformValues($response['values'], Board::class));
    }

    /**
     * Creates a new board.
     * Board name, type and filter Id is required.
     *
     * @param array $data
     * 
     * @throws Exception
     * 
     * @return Board
     */
    public function create(array $data)
    {
        $validator = new BoardValidator($data);

        if ($validator->validate()) {

            $request = $this->newRequest()
                ->setMethod('POST')
                ->setEndpoint($this->endpoints[__FUNCTION__])
                ->setParams($data);

            return new Board($this->sendRequest($request));
        }

        return null;
    }

    /**
     * Deletes the board.
     *
     * @param int $boardId
     */
    public function delete(int $boardId)
    {

    }

    /**
     * Returns all issues from the board's backlog, for the given $boardId.
     * This only includes issues that the user has permission to view.
     * The backlog contains incomplete issues that are not assigned to any future or active sprint.
     * Note, if the user does not have permission to view the board, no issues will be returned at all.
     * Issues returned from this resource include Agile fields, like sprint, closedSprints, flagged, and epic.
     * By default, the returned issues are ordered by rank.
     *
     * @param int $boardId
     *
     * @return Collection
     */
    public function getBackLogIssues(int $boardId)
    {
        $request = $this->newRequest()
            ->setMethod('GET')
            ->setEndpoint(str_replace('{boardId}', $boardId, $this->endpoints[__FUNCTION__]));

        $response = $this->sendRequest($request);

        return new Collection($this->transformValues($response['issues'], Issue::class));
    }

    /**
     * Get the board configuration
     *
     * @param int $boardId
     */
    public function getConfiguration(int $boardId)
    {

    }


    /**
     * Returns all sprints from a board, for a given $boardId.
     * This only includes sprints that the user has permission to view.
     *
     * @param int $boardId
     * 
     * @return Collection
     */
    public function getSprints(int $boardId)
    {
        $request = $this->newRequest()
            ->setMethod('GET')
            ->setEndpoint(str_replace('{boardId}', $boardId, $this->endpoints[__FUNCTION__]));

        $response = $this->sendRequest($request);

        return new Collection($this->transformValues($response['values'], Sprint::class));
    }

}