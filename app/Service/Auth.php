<?php

namespace App\Service;

class Auth
{
    const PERM = [
        'NONE'          => 0b00000000,
        'READ_OWN'      => 0b00000001,
        'READ_GROUP'    => 0b00000010,
        'READ_ALL'      => 0b00000111,
        'WRITE_OWN'     => 0b00001000,
        'WRITE_GROUP'   => 0b00010000,
        'WRITE_ALL'     => 0b00011000,
        'FULL'          => 0b11111111
    ];

    public static function hasPermission(string $module, string $permission, array $available): bool
    {
        foreach ($available as $mod => $perm) {
            if (fnmatch($mod, $module) && ($permission & $perm)) {
                return true;
            }
        }

        return false;
    }
}
