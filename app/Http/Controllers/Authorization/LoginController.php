<?php

namespace App\Http\Controllers\Authorization;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\SSO;
use App\Service\PortalTA\SSO as PortalTaSso;
use App\Service\Authentication\User as LocalUser;

class LoginController extends Controller
{
    const SESSION_KEY = 'auth';

    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $nik  = $request->input('nik');
        $pass = $request->input('pass');
        $rememberUser = $request->input('remember');

        $ssoResult = SSO::checkCredential($nik, $pass);

        if ($ssoResult->success) {
            // TODO: user data via auth table and hrmista
            $authSession = $this->generateLocalUser($nik, $pass, $ssoResult, $rememberUser);
            $request->session()->put(self::SESSION_KEY, $authSession);

            return $this->successResponse($request, $authSession->rememberToken);
        } else {
            $localUser = LocalUser::getByLocalCredential($nik, $pass);
            if ($localUser) {
                $request->session()->put(self::SESSION_KEY, $localUser);
                if ($rememberUser) {
                    $this->ensureLocalUserHasRememberToken($localUser);
                }

                return $this->successResponse($request, $localUser->remember_token);
            }

            return $this->failureResponse($request, $ssoResult);
        }
    }

    public function logout(Request $request)
    {
        //$request->session()->forget(self::SESSION_KEY);
        $request->session()->flush();
        return redirect('/login')->cookie('persistent-token', '', 0, '', '', true, true);
    }

    private function generateLocalUser($nik, $pass, $ssoResult, $rememberUser)
    {
        $localUser = LocalUser::getByLogin($nik);
        if (!$localUser) {
            $ssoCookie = serialize(PortalTaSso::getCookie($nik, $pass));
            $data = [
                'login'          => $nik,
                'nama'           => $ssoResult->nama,
                'pass'           => $pass,
                'sso_cookie'     => $ssoCookie,
                'remember_token' => $this->generateRememberToken($nik)
            ];

            $insertId = LocalUser::create($data);
            $localUser = LocalUser::getById($insertId);
        } elseif ($rememberUser) {
            $this->ensureLocalUserHasRememberToken($localUser);
        }

        return $localUser;
    }

    private function ensureLocalUserHasRememberToken($localUser)
    {
        $token = $localUser->remember_token;

        if (!$localUser->remember_token) {
            $token = $this->generateRememberToken($localUser->login);
            LocalUser::update($localUser->id, [
                'remember_token' => $token
            ]);
            $localUser->remember_token = $token;
        }

        return $token;
    }

    private function generateRememberToken($nik)
    {
        return md5($nik . microtime());
    }

    private function successResponse(Request $request, $rememberToken)
    {
        if ($request->session()->has('auth-originalUrl')) {
            $url = $request->session()->pull('auth-originalUrl');
        } else {
            $url = '/';
        }

        $response = redirect($url);
        if ($rememberToken) {
            $response->cookie('persistent-token', $rememberToken, 0, '', '', true, true);
        }

        return $response;
    }

    private function failureResponse(Request $request, $ssoResult): RedirectResponse
    {
        // flash old input
        $request->flash();

        switch ($ssoResult->error) {
            case SSO::ERR_PASSWORD_WRONG:
                $alertText = '<strong>Password</strong> salah. User akan dikunci jika 3x salah password';
                break;

            case SSO::ERR_USER_NOT_EXIST:
                $alertText = '<strong>NIK</strong> tidak terdaftar';
                break;
        }

        return back()->with('alerts', [
            [
                'type' => 'danger',
                'text' => $alertText
            ]
        ]);
    }
}
