<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 22.07.16
 * Time: 10:44
 */

namespace Silwerclaw\Jirapi;
use Silwerclaw\Jirapi\Exceptions\Exception;
use Silwerclaw\Jirapi\Interfaces\AuthInterface;
use Silwerclaw\Jirapi\Interfaces\ServiceInterface;

/**
 * Class Jirapi
 * @package Silwerclaw\Jirapi
 */
class Jirapi
{

    /**
     * @var AuthInterface
     */
    protected $authenticator;

    /**
     * Jirapi constructor.
     * 
     * @param AuthInterface $authenticator
     */
    public function __construct(AuthInterface $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    /**
     * @param AuthInterface $authenticator
     * 
     * @return $this
     */
    public function setAuthenticator(AuthInterface $authenticator)
    {
        $this->authenticator = $authenticator;
        
        return $this;
    }

    /**
     * @return AuthInterface
     */
    public function getAuthenticator()
    {
        return $this->authenticator;
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

        return with(new $className)->initBuilder();
    }

}