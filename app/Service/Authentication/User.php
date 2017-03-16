<?php

namespace App\Service\Authentication;

use Illuminate\Support\Facades\DB;
use App\Service\Auth;

class User
{
    public static function getByLocalCredential($user, $pass)
    {
        $result = DB::table('auth.user')->where([
            'login'     => $user,
            'pass'      => $pass,
            'is_local'  => true
        ])->first();

        if ($result) {
            return self::deserializePermission($result);
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

    public static function update($id, array $data)
    {
        return DB::table('auth.user')->where('id', $id)->update($data);
    }

    private static function deserializePermission($user)
    {
        $user->permission = Auth::deserializePermission($user->permission);

        return $user;
    }
}
