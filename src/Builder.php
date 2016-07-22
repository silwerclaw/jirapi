<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 14:45
 */

namespace Silwerclaw\Jirapi;

use Silwerclaw\Jirapi\Interfaces\ServiceInterface;

/**
 * Class Builder
 * @package Silwerclaw\Jirapi
 */
class Builder
{

    /**
     * @var int
     */
    protected $limit = 50;

    /**
     * @var
     */
    protected $skip = 0;

    /**
     * @var int
     */
    protected $total = 0;

    /**
     * @var string
     */
    protected $jql = '';

    /**
     * @var ServiceInterface
     */
    protected $service;

    /**
     * Builder constructor.
     * @param ServiceInterface $service
     */
    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }
    
    /**
     * @param $limit
     *
     * @return $this
     */
    public function limit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param $skip
     * 
     * @return $this
     */
    public function skip($skip)
    {
        $this->skip = $skip;

        return $this;
    }

    /**
     * @param string $jql
     *
     * @return $this
     */
    public function jql(string $jql)
    {
        $this->jql = $jql;

        return $this;
    }

    public function __call($method, $arguments = [])
    {
        return call_user_func_array([$this->service, $method], $arguments);
    }

}