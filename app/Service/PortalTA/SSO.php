<?php

namespace App\Service\PortalTA;

use GuzzleHttp\Client as HttpClient;

class SSO
{

    public function login($nik, $pass)
    {
        $path   = escapeshellarg(__DIR__.'/SSO.js');
        $nik    = escapeshellarg($nik);
        $pass   = escapeshellarg($pass);
        $cmd    = escapeshellcmd("node $path $nik $pass");
        $result = json_decode(shell_exec($cmd));

        if ($result === null) {
            throw new \RuntimeException('shell_exec');
        }

        if (isset($result->error)) {
            switch ($result->error) {
                case 'InvalidArgument':
                    throw new \InvalidArgumentException();
                    break;

                case 'RequestFailed':
                case 'UnhandledRejection':
                    throw new \RuntimeException($result);
                    break;
            }
        }

        // should return cookie
        // all other API in PortalTA should expect cookie

        return $result;
    }
}
