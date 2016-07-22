<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 14:45
 */

namespace Silwerclaw\Jirapi\Services;


use Silwerclaw\Jirapi\Builder;
use Silwerclaw\Jirapi\Interfaces\ServiceInterface;

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
     * Transfomr raw values to entities
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
    
}