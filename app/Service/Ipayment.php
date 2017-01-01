<?php

namespace App\Service;

class Ipayment
{
    public static function request($jastel)
    {
        $path = __DIR__.'/Ipayment.js';
        $cmd = "node $path $jastel";
        $result = json_decode(shell_exec($cmd));

        return $result;
    }
}