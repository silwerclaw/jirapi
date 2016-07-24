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

/**
 * Class Entity
 * @package Silwerclaw\Jirapi\Entities
 */
abstract class Entity extends Fluent
{

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

}