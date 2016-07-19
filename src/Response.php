<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 20.07.16
 * Time: 0:55
 */

namespace Silwerclaw\Jirapi;


use Silwerclaw\Jirapi\Interfaces\RequestInterface;
use Silwerclaw\Jirapi\Interfaces\ResponseInterface;

class Response implements ResponseInterface
{
    /**
     * @var RequestInterface
     */
    private $request;
    
    /**
     * @var array
     */
    private $rawData;

    /**
     * Response constructor.
     * 
     * @param RequestInterface $request
     * @param array $rawData
     */
    public function __construct(RequestInterface $request, array $rawData = [])
    {
        $this->request = $request;
        $this->rawData = $rawData;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function setRequest(RequestInterface $request) : ResponseInterface
    {
        $this->request = $request;
        
        return $this;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest() : RequestInterface
    {
        return $this->request;
    }

    /**
     * @param array $rawData
     *
     * @return ResponseInterface
     */
    public function setRaw(array $rawData) : ResponseInterface
    {
        $this->rawData = $rawData;
        
        return $this;
    }

    /**
     * @return array
     */
    public function getRaw() : array
    {
        return $this->rawData;
    }
}