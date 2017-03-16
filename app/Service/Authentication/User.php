<?php

namespace App\Service\Authentication;

use Illuminate\Support\Facades\DB;

class User
{
    public static function getByCredential($user, $pass)
    {
        $result = DB::select("
            SELECT *
            FROM auth.user
            WHERE
              login = ? AND pass = ?
        ", [
            $user, $pass
        ]);

        if (count($result)) {
            return self::deserializePermission($result[0]);
        } else {
            return false;
        }
    }

    public static function getByRememberToken($token)
    {
        $result = DB::table('auth.user')->where('remember_token', $token)->first();

        if ($result) {
            return self::deserializePermission($result);
        } else {
            return false;
        }
    }

    public static function getByLogin($login)
    {
        $result = DB::table('auth.user')->where('login', $login)->first();

        if ($result) {
            return self::deserializePermission($result);
        } else {
            return false;
        }
    }

    public static function getById($id)
    {
        $result = DB::table('auth.user')->where('id', $id)->first();

        if ($result) {
            return self::deserializePermission($result);
        } else {
            return false;
        }
    }

    public static function create(array $data)
    {
        return DB::table('auth.user')->insertGetId($data);
    }

    private static function deserializePermission($user)
    {
        $permission = json_decode($user->permission);
        $user->permission = $permission;
        return $user;
    }
}
