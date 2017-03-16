<?php

namespace App\Service\Authentication;

class User
{
    public static function getByCredential($user, $pass)
    {
        $result = DB::select("
            SELECT *
            FROM auth.user
            WHERE
              login = ? AND pass = ?
        ",[
            $user, $pass
        ]);

        if (count($result)) {
            return self::deserializePermission($result[1]);
        }
        else {
            return false;
        }
    }

    public static function getByRememberToken($token)
    {
        $result = DB::select("
            SELECT *
            FROM auth.user
            WHERE remember_token = ?
        ",[$token]);

        if (count($result)) {
            return self::deserializePermission($result[1]);
        }
        else {
            return false;
        }
    }

    public static function getByLogin($login)
    {
        $result = DB::select("
            SELECT *
            FROM auth.user
            WHERE login = ?
        ",[$login]);

        if (count($result)) {
            return self::deserializePermission($result[1]);
        }
        else {
            return false;
        }
    }

    private static function deserializePermission($user)
    {
        $permission = json_decode($user->permission);
        $user->permission = $permission;
        return $user;
    }
}
