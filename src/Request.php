<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 20.07.16
 * Time: 0:35
 */

namespace Silwerclaw\Jirapi;

use Silwerclaw\Jirapi\Interfaces\RequestInterface;
use Silwerclaw\Jirapi\Interfaces\ResponseInterface;

class Request implements RequestInterface
{
    /**
     * @var Authenticator
     */
    protected $authenticator;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Request constructor.
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }


    /**
     * @return ResponseInterface
     */
    public function doRequest() : ResponseInterface
    {
        // TODO: Implement doRequest() method.
    }

    /**
     * @param string $method
     *
     * @return RequestInterface
     */
    public function setMethod(string $method) : RequestInterface
    {
        $this->method = $method;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @param array $params
     *
     * @return RequestInterface
     */
    public function setParams(array $params) : RequestInterface
    {
        $this->params = $params;
        
        return $this;
    }

    /**
     * @return array
     */
    public function getParams() : array
    {
        return $this->params;
    }

    /**
     * @param Authenticator $auth
     *
     * @return RequestInterface
     */
    public function setAuthenticator(Authenticator $auth) : RequestInterface
    {
        $this->authenticator = $auth;
        
        return $this;
    }

    /**
     * @return Authenticator
     */
    public function getAuthenticator() : Authenticator
    {
        return $this->authenticator;
    }
}