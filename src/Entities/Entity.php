<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 15:24
 */

namespace Silwerclaw\Jirapi\Entities;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;
use Silwerclaw\Jirapi\Exceptions\Exception;
use Silwerclaw\Jirapi\Interfaces\ServiceInterface;
use Silwerclaw\Jirapi\Jirapi;

/**
 * Class Entity
 * @package Silwerclaw\Jirapi\Entities
 */
abstract class Entity extends Fluent
{

    /**
     * @var string
     */
    protected $service;

    /**
     * Get entity by id/key
     *
     * @param int $entityKey
     *
     * @return Entity
     */
    public static function find($entityKey)
    {
        $instance = new static;

        return $instance->getService()->get($entityKey);
    }

    /**
     * @param array $attributes
     *
     * @throws Exception
     * @return Entity
     */
    public static function create(array $attributes)
    {
        $instance = new static;

        return $instance->getService()->create($attributes);
    }

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $value = parent::get($key, $default);
        
        return $this->hasGetMutator($key) ? $this->mutateAttribute($key, $value) : $value;
    }

    /**
     * Convert the Fluent instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(function($key, $attribute) {
            
            if ($this->hasGetMutator($key)) {
                $attribute = $this->mutateAttribute($key, $attribute);
            }

            return $attribute instanceof Arrayable ? $attribute->toArray() : $attribute;
        }, array_keys($this->attributes), $this->attributes);
    }

    /**
     * Determine if a get mutator exists for an attribute.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasGetMutator($key)
    {
        return method_exists($this, 'get'.Str::studly($key).'Attribute');
    }

    /**
     * Get the value of an attribute using its mutator.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function mutateAttribute($key, $value)
    {
        return $this->{'get'.Str::studly($key).'Attribute'}($value);
    }

    /**
     * @return ServiceInterface
     */
    protected function getService()
    {
        return app()->make(Jirapi::class)->getService($this->service);
    }

    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (in_array($method, ['getService'])) {
            return call_user_func_array([$this, $method], $parameters);
        }

        $service = $this->getService();

        return call_user_func_array([$service, $method], $parameters);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $instance = new static;

        return call_user_func_array([$instance, $method], $parameters);
    }

}