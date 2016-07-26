<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 14:45
 */

namespace Silwerclaw\Jirapi;


/**
 * Class Builder
 * @package Silwerclaw\Jirapi
 */
class Builder
{

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param $limit
     *
     * @return $this
     */
    public function limit($limit)
    {
        $this->params['maxResults'] = $limit;

        return $this;
    }

    /**
     * @param $skip
     *
     * @return $this
     */
    public function skip($skip)
    {
        $this->params['startAt'] = $skip;

        return $this;
    }

    /**
     * @return array
     */
    public function toParams()
    {
        return $this->params;
    }

    /**
     * @param $key
     * @param $value
     * 
     * @return $this
     */
    public function where($key, $value)
    {
        if (is_array($key)) {
            foreach ($key as $k => $value) {
                $this->where($k, $value);
            }
        } else {
            $this->params[$key] = $value;
        }
        
        return $this;
    }
    
}