<?php

namespace App\Service\PortalTA;

class SSO
{
    const INDEX_URL = 'http://apps.telkomakses.co.id/portal/index.php';
    const LOGIN_URL = 'http://telkomakses.co.id/login';

    public static function login($nik, $pass)
    {
        $jar = new \GuzzleHttp\Cookie\CookieJar();
        $http = new \GuzzleHttp\Client();

        $response = $http->request('POST', self::INDEX_URL, [
            'form_params' => [
                'nik'      => $nik,
                'password' => $pass
            ],
            'allow_redirects' => false,
            'cookies' => $jar
        ]);
        $cookies = $jar->toArray();

        return $cookies;
    }
}
