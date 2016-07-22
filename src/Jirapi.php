<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 10:44
 */

namespace Silwerclaw\Jirapi;
use Silwerclaw\Jirapi\Exceptions\Exception;
use Silwerclaw\Jirapi\Interfaces\ServiceInterface;

/**
 * Class Jirapi
 * @package Silwerclaw\Jirapi
 */
class Jirapi
{

    /**
     * @var Authenticator
     */
    public static $authenticator;

    /**
     * Jirapi constructor.
     * 
     * @param Authenticator $authenticator
     */
    public function __construct(Authenticator $authenticator)
    {
        self::$authenticator = $authenticator;
    }

    /**
     * @param Authenticator $authenticator
     * 
     * @return $this
     */
    public function setAuthenticator(Authenticator $authenticator)
    {
        self::$authenticator = $authenticator;
        
        return $this;
    }

    /**
     * @return Authenticator
     */
    public static function getAuthenticator()
    {
        return self::$authenticator;
    }

    /**
     * Get Jira Service handler by name
     *
     * @param string $name
     *
     * @return ServiceInterface
     *
     * @throws Exception
     */
    public function getService($name)
    {
        $servicesNamespace = __NAMESPACE__ . '\\' . 'Services\\';

        $className = $servicesNamespace . ucfirst(strtolower($name)) . 'Service';
        
        if (! class_exists($className)) {
            throw new Exception('Service "' . $name . '" not found');
        }

        return new Builder(new $className);
    }

}