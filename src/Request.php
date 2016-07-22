<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 20.07.16
 * Time: 0:35
 */

namespace Silwerclaw\Jirapi;

use GuzzleHttp\Client;
use Silwerclaw\Jirapi\Exceptions\Exception;
use Silwerclaw\Jirapi\Interfaces\RequestInterface;

/**
 * Class Request
 * @package Silwerclaw\Jirapi
 */
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
     * @var string
     */
    protected $endpoint;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->authenticator = Jirapi::getAuthenticator();

        if (!($this->authenticator instanceof Authenticator)) {
            throw new Exception('Authenticator not defined for Jira REST API');
        }
        
        $this->httpClient = new Client();
    }

    /**
     * @return array
     */
    public function doRequest() : array
    {
        $request = $this->httpClient->createRequest(
            $this->method,
            $this->getUrl(),
            $this->makeRequestConfig()
        );
        
        return $this->httpClient->send($request)->json();
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

    /**
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return RequestInterface
     */
    public function setEndpoint(string $endpoint) : RequestInterface
    {
        $this->endpoint = $endpoint;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return rtrim($this->authenticator->getHost(), '/') . '/' . ltrim($this->endpoint, '/');
    }

    /**
     * @return array
     */
    protected function makeRequestConfig() : array
    {
        $config = [];
        
        //add authorization header
        $config['auth'] = [$this->authenticator->getLogin(), $this->authenticator->getPassword()];

        //add proper content type
        $config['headers']['Content-Type'] = 'application/json'; 
        
        //add parameters
        if (!empty($this->params)) {
            if ($this->method == 'GET') {
                $config['query'] = $this->params;
            } else {
                $config['body'] = json_encode($this->params);
            }
        }
        
        return $config;
    }
}