<?php

namespace App\Authentication;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class User implements Authenticatable
{
    private $token;
    public function __construct($token) {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        $response = Http::withToken($this->token)->timeout(30)->get(\getenv('AUTH_ENDPOINT')); //'http://localhost/--%20DIPLOMA%20--/meet-your-elf-auth/public/token/json'
        if($response->failed()) {
            return [
                'auth' => false,
                'errors' => $response['errors']
            ];
        }

        return [
            'auth' => true,
            'data' => [
                'id' => sha1($response['data']['email']),
                'name' => $response['data']['name'],
                'surname' => $response['data']['surname'],
                'email' => $response['data']['email']
            ]
        ];
    }



    //---------------------- !! V BELOW NOT USING V !! ---------------------- //

    /**
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return '';
    }


    /**
     * @return string
     */
    public function getAuthPassword()
    {
        return '';
    }

    /**
     * @return string
     */
    public function getRememberToken()
    {
        return '';
    }

    /**
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
    }

    /**
     * @return string
     */
    public function getRememberTokenName()
    {
        return '';
    }
}