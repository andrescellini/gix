<?php


/**
 * @SWG\Definition(required={ "email", "password"}, type="object", @SWG\Xml(name="Login"))
 */

class Login
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $email;
    
    /**
     * @SWG\Property()
     * @var string
     */
    public $password;
}

/**
 * @SWG\Definition(required={ "refresh_token" }, type="object", @SWG\Xml(name="Refresh"))
 */

class Refresh
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $refresh_token;

}
