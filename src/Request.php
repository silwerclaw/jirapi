<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 20.07.16
 * Time: 0:35
 */

namespace Silwerclaw\Jirapi;

use GuzzleHttp\Client;
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
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
        $this->httpClient = new Client();
    }


    /**
     * @return ResponseInterface
     */
    public function doRequest() : ResponseInterface
    {
        $request = $this->httpClient->createRequest(
            $this->method,
            $this->getUrl(),
            $this->makeRequestConfig()
        );
        
        $result = $this->httpClient->send($request)->json();
        
        return new Response($this, $result);
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
        
        //add post data
        if ($this->method == 'POST' && !empty($this->params)) {
            $config['body'] = json_encode($this->params);
        }
        
        return $config;
    }
}