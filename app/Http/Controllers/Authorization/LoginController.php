<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\SSO;
use App\Service\Authentication\User as LocalUser;

class LoginController extends Controller
{
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
            $authSession = $this->generateSSOSession($nik, $pass);
            $request->session()->put('auth', $authSession);

            return $this->successResponse($request);
        } elseif ($localUser = LocalUser::getByCredential($nik, $pass)) {
            $authSession = $this->generateLocalSession($localUser);
            $request->session()->put('auth', $authSession);

            return $this->successResponse($request);
        } else {
            $localUser = LocalUser::getByCredential($nik, $pass);

            return $this->failureResponse($request, $ssoResult);
        }
    }

    private function generateSSOSession($nik, $pass)
    {}

    private function generateUserData($nik, $pass)
    {}

    private function generateLocalSession($localUser)
    {
    }

    private function successResponse(Request $request)
    {
        if ($request->session()->has('auth-originalUrl')) {
            $url = $request->session()->pull('auth-originalUrl');
        } else {
            $url = '/';
        }

        return redirect($url);
    }

    private function failureResponse(Request $request, $ssoResult): \Illuminate\Http\RedirectResponse
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
