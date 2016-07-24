<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 14:45
 */

namespace Silwerclaw\Jirapi\Services;


use Silwerclaw\Jirapi\Builder;
use Silwerclaw\Jirapi\Exceptions\Exception;
use Silwerclaw\Jirapi\Interfaces\RequestInterface;
use Silwerclaw\Jirapi\Interfaces\ServiceInterface;
use Silwerclaw\Jirapi\Request;

/**
 * Class Service
 * @package Silwerclaw\Jirapi\Services
 */
abstract class Service implements ServiceInterface
{

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Builder $builder
     * 
     * @return $this
     */
    public function setBuilder(Builder $builder)
    {
        $this->builder = $builder;
        
        return $this;
    }

    /**
     * @return Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @return $this
     */
    public function initBuilder()
    {
        $this->builder = $this->newBuilder();

        return $this;
    }

    /**
     * @return Builder
     */
    public function newBuilder()
    {
        return new Builder();
    }

    /**
     * Transform raw values to entities
     * 
     * @param array $values
     * @param string $entityClass
     * 
     * @return array
     */
    protected function transformValues(array $values, string $entityClass)
    {
        return array_map(function($value) use($entityClass) {
            return new $entityClass($value);
        }, $values);
    }

    /**
     * @return RequestInterface
     */
    protected function newRequest()
    {
        return new Request();
    }

    /**
     * @param RequestInterface $request
     * 
     * @return array
     */
    protected function sendRequest(RequestInterface $request)
    {
        $this->mergeBuilderParams($request)->setBuilder($this->newBuilder());
        
        return $request->doRequest();
    }

    /**
     * @param RequestInterface $request
     *
     * @return $this
     */
    protected function mergeBuilderParams(RequestInterface $request)
    {
        if ($request->getMethod() == 'GET') {
            $request->setParams(array_merge($request->getParams(), $this->builder->toParams()));
        }
        
        return $this;
    }
    
    public function __call($method, $arguments = [])
    {
        if (method_exists($this->builder, $method)) {

            call_user_func_array([$this->builder, $method], $arguments);
        }
        
        return $this;
    }
    
}