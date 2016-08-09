<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 06.08.16
 * Time: 10:38
 */

namespace Silwerclaw\Jirapi\Auth;


use Silwerclaw\Jirapi\Interfaces\AuthInterface;
use Silwerclaw\Jirapi\Interfaces\RequestInterface;


/**
 * Class Basic
 * @package Silwerclaw\Jirapi\Auth
 */
class Basic implements AuthInterface
{

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * Basic constructor.
     * 
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {
        $this->host = $credentials['host'];
        $this->login = $credentials['login'];
        $this->password = $credentials['password'];
    }

    /**
     * @param RequestInterface $request
     * 
     * @return $this;
     */
    public function authenticate(RequestInterface $request)
    {
        $request->setOption('auth', [$this->getLogin(), $this->getPassword()]);
        
        return $this;
    }

    /**
     * @return string
     */
    public function getHost() : string
    {
        return $this->host;
    }

    /**
     * @param string $host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return string
     */
    public function getLogin() : string
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorizationHeader() : string
    {
        return 'Basic ' . base64_encode($this->login . ':' . $this->password);
    }

}