<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 20.07.16
 * Time: 0:03
 */

namespace Silwerclaw\Jirapi\Interfaces;


/**
 * Interface RequestInterface
 * @package Silwerclaw\Jirapi\Interfaces
 */
interface RequestInterface
{

    /**
     * @return array
     */
    public function doRequest() : array;

    /**
     * @param string $method
     *
     * @return RequestInterface
     */
    public function setMethod(string $method) : RequestInterface;

    /**
     * @return string
     */
    public function getMethod() : string;

    /**
     * @param array $params
     * 
     * @return RequestInterface
     */
    public function setParams(array $params) : RequestInterface;

    /**
     * @return array
     */
    public function getParams() : array;

    /**
     * @return string
     */
    public function getEndpoint() : string;

    /**
     * @param string $endpoint
     * 
     * @return RequestInterface
     */
    public function setEndpoint(string $endpoint) : RequestInterface;

    /**
     * @return string
     */
    public function getUrl() : string;

}