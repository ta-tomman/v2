<?php

namespace App\Service\PortalTA;

class SSO
{
    const LOGIN_URL = 'http://telkomakses.co.id/login/';
    const INDEX_URL = 'http://apps.telkomakses.co.id/portal/index.php';

    public static function login($nik, $pass)
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $http = new \GuzzleHttp\Client();

        $http->request('GET', self::LOGIN_URL, [
            'cookies' => $jar
        ]);
        $http->request('POST', self::LOGIN_URL, [
            'form_params' => [
                'username' => $nik,
                'password' => $pass
            ],
            'cookies' => $jar
        ]);
        $cookies = $jar->toArray();
        $response = $http->request('GET', self::INDEX_URL, [
            'allow_redirects' => false,
            'cookies' => $jar
        ]);

        $result = $response->getStatusCode();

        // should return cookie
        // all other API in PortalTA should expect cookie

        return $result;
    }
}
