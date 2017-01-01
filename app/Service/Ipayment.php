<?php

namespace App\Service;

class Ipayment
{
    public static function request($jastel)
    {
        $path = __DIR__.'/Ipayment.js';
        $cmd = "node $path $jastel";
        $result = json_decode(shell_exec($cmd));

        switch ($result->error) {
            case 'InvalidArgument':
                throw new \InvalidArgumentException();
            break;
        }

        return $result;
    }
}