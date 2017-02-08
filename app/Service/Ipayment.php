<?php

namespace App\Service;

class Ipayment
{
    public static function request($jastel)
    {
        $path   = escapeshellarg(__DIR__.'/Ipayment.js');
        $jastel = escapeshellarg($jastel);
        $cmd    = escapeshellcmd("node $path $jastel");
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

        return $result;
    }
}
