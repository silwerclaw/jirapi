<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 19.07.16
 * Time: 23:59
 */

namespace Silwerclaw\Jirapi;


class Authenticator
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
     * Client constructor.
     * 
     * @param string $host
     * @param string $login
     * @param string $password
     */
    public function __construct(string $host, string $login, string $password)
    {
        $this->host = $host;
        $this->login = $login;
        $this->password = $password;
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
     * @return Authenticator
     */
    public function setHost($host) : Authenticator
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
     * @return Authenticator
     */
    public function setLogin($login) : Authenticator
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
     * @return Authenticator
     */
    public function setPassword($password) : Authenticator
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