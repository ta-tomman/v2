<?php

namespace App\Service;

use GuzzleHttp\Client as HttpClient;

class SSO
{
    const LOGIN_URL = 'http://api.telkomakses.co.id/API/sso/auth_sso_post.php';

    const ERR_NONE = 0;
    const ERR_USER_NOT_EXIST = -1;
    const ERR_PASSWORD_WRONG = -2;

    public static function login($nik, $password)
    {
        $http = new HttpClient();
        $response = $http->request('POST', self::LOGIN_URL, [
            'form_params' => [
                'username' => $nik,
                'password' => $password
            ]
        ]);

        $result = new \stdClass();
        $ssoResult = json_decode($response->getBody());
        switch ($ssoResult->auth) {
            // Login Success
            case 'Yes':
                $result->success = true;
                $result->error   = self::ERR_NONE;
                $result->name    = $ssoResult->nama;
                break;

            // Valid User, Wrong Password
            case 'WP':
                $result->success = false;
                $result->error   = self::ERR_PASSWORD_WRONG;
                break;

            // User not exists
            case 'No':
                $result->success = false;
                $result->error   = self::ERR_USER_NOT_EXIST;
                break;
        }

        return $result;
    }
}
