<?php

namespace App\Infrastructure\Auth;

use Illuminate\Foundation\Application;
use App\Infrastructure\Auth\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class LoginProxy
{
    
    use ThrottlesLogins;

    const REFRESH_TOKEN = 'refreshToken';

    private $apiConsumer;

    private $auth;

    private $cookie;

    private $db;

    private $request;


    public function __construct(Application $app) {

        $this->apiConsumer = $app->make('apiconsumer');
        $this->auth = $app->make('auth');
        $this->cookie = $app->make('cookie');
        $this->db = $app->make('db');
        $this->request = $app->make('request');
    }

    public function username()
    {
        return 'email';
    }

    /**
     * Attempt to create an access token using user credentials
     *
     * @param string $email
     * @param string $password
     */
    public function attemptLogin($email, $password)
    {
        
        $request = request();
        
        if ($this->hasTooManyLoginAttempts($request)) {
            
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);

        }

        $this->incrementLoginAttempts($request);

        $user = User::where('email', $email)->first();

        

        if (!is_null($user)) {
            return $this->proxy('password', [
                'username' => $email,
                'password' => $password
            ],$user);
        }

        throw new InvalidCredentialsException('credenciales invalidas');
    }

    /**
     * Attempt to refresh the access token used a refresh token that 
     * has been saved in a cookie
     */
    public function attemptRefresh($refreshToken)
    {
        //$refreshToken = $this->request->cookie(self::REFRESH_TOKEN);

        return $this->proxy('refresh_token', [
            'refresh_token' => $refreshToken
        ],false);
    }

    /**
     * Proxy a request to the OAuth server.
     * 
     * @param string $grantType what type of grant type should be proxied
     * @param array $data the data to send to the server
     */
    public function proxy($grantType, array $data = [])
    {
        
        
        $data = array_merge($data, [
            'client_id'     => env('PASSWORD_CLIENT_ID'),
            'client_secret' => env('PASSWORD_CLIENT_SECRET'),
            'grant_type'    => $grantType
        ]);



        $response = $this->apiConsumer->post('/oauth/token', $data);
        

        if (!$response->isSuccessful()) {
            
            $this->incrementLoginAttempts(request());

            throw new InvalidCredentialsException('credenciales invalidas');
        }

        $data = json_decode($response->getContent());


        /*
        $this->cookie->queue(
            self::REFRESH_TOKEN,
            $data->refresh_token,
            864000, // 10 days
            null,
            null,
            false,
            true // HttpOnly
        );
        */
    
        return [
            'access_token' => $data->access_token,
            'expires_in' => $data->expires_in,
            'refresh_token' => $data->refresh_token
        ];
    }

    /**
     * Logs out the user. We revoke access token and refresh token. 
     * Also instruct the client to forget the refresh cookie.
     */
    public function logout()
    {
        $accessToken = $this->auth->user()->token();

        $refreshToken = $this->db
            ->table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        $this->cookie->queue($this->cookie->forget(self::REFRESH_TOKEN));
    }
}
