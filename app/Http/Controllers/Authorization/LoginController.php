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

        $rememberToken = null;
        if ($rememberUser) {
            $rememberToken = md5($nik . microtime());
        }

        $ssoResult = SSO::checkCredential($nik, $pass);

        if ($ssoResult->success) {
            // TODO: user data via auth table and hrmista
            $authSession = $this->generateLocalUser($nik, $pass, $ssoResult, $rememberToken);
            $request->session()->put(self::SESSION_KEY, $authSession);

            return $this->successResponse($request, $rememberToken);
        } else {
            $localUser = LocalUser::getByLocalCredential($nik, $pass);
            if ($localUser) {
                $request->session()->put(self::SESSION_KEY, $localUser);
                return $this->successResponse($request, $rememberToken);
            }

            return $this->failureResponse($request, $ssoResult);
        }
    }

    private function generateLocalUser($nik, $pass, $ssoResult, $rememberToken)
    {
        $localUser = LocalUser::getByLogin($nik);
        if (!$localUser) {
            $ssoCookie = serialize(PortalTaSso::getCookie($nik, $pass));
            $data = [
                'login'          => $nik,
                'nama'           => $ssoResult->nama,
                'pass'           => $pass,
                'sso_cookie'     => $ssoCookie,
                'remember_token' => $rememberToken
            ];

            $insertId = LocalUser::create($data);
            $localUser = LocalUser::getById($insertId);
        } elseif ($rememberToken) {
            LocalUser::update($localUser->id, [
                'remember_token' => $rememberToken
            ]);
            $localUser->remember_token = $rememberToken;
        }

        return $localUser;
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
