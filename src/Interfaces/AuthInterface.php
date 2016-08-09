<?php
/**
 * Created by PhpStorm.
 * User: silwerclaw
 * Date: 06.08.16
 * Time: 10:38
 */

namespace Silwerclaw\Jirapi\Interfaces;


interface AuthInterface
{

    /**
     * @param RequestInterface $request
     */
    public function authenticate(RequestInterface $request);

}