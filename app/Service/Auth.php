<?php

namespace App\Service;

class Auth
{
    const PERM_NONE          = 0b00000000;
    const PERM_READ_OWN      = 0b00000001;
    const PERM_READ_GROUP    = 0b00000010;
    const PERM_READ_ALL      = 0b00000111;
    const PERM_WRITE_OWN     = 0b00001000;
    const PERM_WRITE_GROUP   = 0b00010000;
    const PERM_WRITE_ALL     = 0b00011000;
    const PERM_FULL          = 0b11111111;

    //shorthands
    const PERM_READ          = self::PERM_READ_ALL;
    const PERM_WRITE         = self::PERM_WRITE_ALL;

    public static function hasPermission(string $module, string $permission, array $available): bool
    {
        foreach ($available as $mod => $perm) {
            if (fnmatch($mod, $module) && ($permission & $perm)) {
                return true;
            }
        }

        return false;
    }

    public static function serializePermission(array $permission)
    {
        // probably not necessary
    }

    public static function deserializePermission(string $serialized)
    {
        $result = [];
        $serialized = trim($serialized);
        if (!$serialized) {
            return $result;
        }

        $tokens = explode(',', $serialized);
        foreach ($tokens as $token) {
            list($key, $val) = explode(':', trim($token));
            $key = trim($key);
            $val = trim($val);

            $className = Auth::class;
            $constName = 'PERM_'.strtoupper($val);
            $result[$key] = constant("$className::$constName");
        }

        return $result;
    }
}
