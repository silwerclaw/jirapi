<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 20.07.16
 * Time: 0:03
 */

namespace Silwerclaw\Jirapi\Interfaces;


use Silwerclaw\Jirapi\Authenticator;

interface RequestInterface
{

    /**
     * @return ResponseInterface
     */
    public function doRequest() : ResponseInterface;

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

    /**
     * @param Authenticator $auth
     * 
     * @return RequestInterface
     */
    public function setAuthenticator(Authenticator $auth) : RequestInterface;

    /**
     * @return Authenticator
     */
    public function getAuthenticator() : Authenticator;

}