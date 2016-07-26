<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 25.07.16
 * Time: 9:31
 */

namespace Silwerclaw\Jirapi\Services;
use Silwerclaw\Jirapi\Collections\Collection;
use Silwerclaw\Jirapi\Entities\Issue;

/**
 * Class SearchService
 * @package Silwerclaw\Jirapi\Services
 */
class SearchService extends Service
{

    protected $endpoints = [
        'search'           => '/rest/api/2/search'
    ];

    /**
     * Searches for issues using JQL.
     *
     * @param $jql
     *
     * @return Collection
     */
    public function search($jql)
    {
        $request = $this->newRequest()
            ->setMethod('POST')
            ->setEndpoint($this->endpoints[__FUNCTION__])
            ->setParams(['jql' => $jql]);

        $response = $this->sendRequest($request);

        return new Collection($this->transformValues($response['issues'], Issue::class));
    }

}