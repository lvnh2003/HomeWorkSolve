<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassWordRequest;
use App\Mail\ActiveMail;
use App\Mail\ForgotMail;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index()
    {

        return view('users.login.login');
    }
    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
                'g-recaptcha-response' => 'captcha'
            ],
            [
                'required' => 'Trường này không được bỏ trống !',
                'email' => 'Không đúng định dạng email',
                'captcha' => 'Vui lòng xác nhận Capcha',
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {

            if (Auth::user()->isActive != 1) {
                return redirect()->back()->withErrors(['errorLogin' => 'Tài khoản của bạn đã bị khóa!']);
            } else {
                if ($request->urlRedirect) {
                    return redirect($request->urlRedirect);
                }
                return redirect()->route('user.index');
            }
        }
        return redirect()->back()->withErrors(['errorLogin' => 'Email hoặc mật khẩu không chính xác!']);
    }
    public function forgot()
    {
        return view('users.login.forgot');
    }
    public function checkMail(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',


            ],
            [
                'required' => 'Trường này không được bỏ trống !',
                'email' => 'Không đúng định dạng email',

            ]
        );
        $email = $request->email;
        $userLogin = Login::where('email', $email)->first();

        if ($userLogin) {
            $activeToken = base64_encode($request->email);
            $route = route('resetPass', $activeToken);
            if (Mail::to($userLogin->email)->send(new ForgotMail($route))) {
                return redirect()->back()->with('success', 'Vui lòng kiểm tra email');
            }
        } else {
            return redirect()->back()->withErrors(['errorLogin' => 'Email không chính xác!']);
        }
    }
    public function resetPass($token)
    {

        if (User::where('activeToken', $token)->first()) {
            return view('users.login.reset', ['token' => $token]);
        }
        return view('errors.404');
    }
    public function confirm(ResetPassWordRequest $request, $token)
    {

        $user = User::where('activeToken', $token)->first();
        $userLogin = Login::where('idUsers', $user->id)->first();

        if ($userLogin->update([
            'password' => bcrypt($request->password),
        ])) {
            if (Auth::loginUsingId($userLogin->id)) {
                return redirect()->route('user.index');
            }
        }
    }
    public function logout()
    {

        Auth::logout();
        return redirect()->route('user.index');
    }
    public function callBack($provider)
    {
        $user = Socialite::driver($provider)->user();
        $userCheck = Login::where('email', $user->email)->first();
        if (!empty($userCheck)) {
            if ($userCheck->isActive != 1) {
                return redirect()->route('login')->withErrors(['errorLogin' => 'Tài khoản của bạn đã bị khóa!']);
            }
            Auth::loginUsingId($userCheck->id);
            return redirect()->route('user.index');
        }
        $userNew = new User();
        $data = [
            'name' => $user['name'],
            'avatar' => $user->avatar
        ];
        $userNew = $userNew->create($data);
        $login = Login::create(
            [
                'email' => $user->email,
                'password' => bcrypt($user['email']),
                'idUsers' => $userNew->id,
            ]
        );
        if ($login) {
            Auth::loginUsingId($login->id);
            return redirect()->route('user.index');
        }
    }
    public function redirect($provider)
    {

        return Socialite::driver($provider)->redirect();
    }
}
