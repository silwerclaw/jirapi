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
use Silwerclaw\Jirapi\Interfaces\AuthInterface;
use Silwerclaw\Jirapi\Interfaces\RequestInterface;

/**
 * Class Request
 * @package Silwerclaw\Jirapi
 */
class Request implements RequestInterface
{
    /**
     * @var AuthInterface
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
     * @var array
     */
    protected $requestOptions = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->authenticator = app()->make(AuthInterface::class);

        if (!$this->authenticator) {
            throw new Exception('Authenticator not defined for Jira REST API');
        }
        
        $this->httpClient = new Client();
    }

    /**
     * @return array
     */
    public function doRequest() : array
    {
        $this->generateRequestOptions();

        $this->authenticator->authenticate($this);

        $request = $this->httpClient->createRequest(
            $this->method,
            $this->getUrl(),
            $this->requestOptions
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
     * Set option to request
     * @see \GuzzleHttp\Message\Request
     *
     * @param $key
     * @param $value
     *
     * @return RequestInterface
     */
    public function setOption($key, $value)  : RequestInterface
    {
        $this->requestOptions[$key] = $value;

        return $this;
    }

    /**
     * @return RequestInterface
     */
    protected function generateRequestOptions() : RequestInterface
    {
        $config = [];

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

        $this->requestOptions = array_merge($this->requestOptions, $config);
        
        return $this;
    }
}