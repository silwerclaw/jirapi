<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 20.07.16
 * Time: 0:07
 */

namespace Silwerclaw\Jirapi\Interfaces;


interface ResponseInterface
{

    /**
     * @param RequestInterface $request
     * 
     * @return ResponseInterface
     */
    public function setRequest(RequestInterface $request) : ResponseInterface;

    /**
     * @return RequestInterface
     */
    public function getRequest() : RequestInterface;

    /**
     * @param array $raw
     *
     * @return ResponseInterface
     */
    public function setRaw(array $raw) : ResponseInterface;

    /**
     * @return array
     */
    public function getRaw() : array;

}