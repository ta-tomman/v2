<?php

namespace App\Service;

use GuzzleHttp\Client as HttpClient;

class SSO
{
    const LOGIN_URL = 'http://api.telkomakses.co.id/API/sso/auth_sso_post.php';

    public static function login($nik, $password)
    {
        $http = new HttpClient();
        $response = $http->request('POST', self::LOGIN_URL, [
            'form_params' => [
                'username' => $nik,
                'password' => $password
            ]
        ]);

        $result = json_decode($response->getBody());
        switch ($result->auth) {

            // Login Success
            case 'Yes':
                break;

            // Valid User, Wrong Password
            case 'WP':
                break;

            // User not exists
            case 'No':
                break;
        }

        return $result;
    }
}
