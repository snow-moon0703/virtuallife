<?php

namespace App\Http\Controllers\EnglishVR;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/englishvr/playrecord';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        //auth('admin') 你自定义的grude  attempt(['要验证的字段'=>'发送过来的值'])
        $res = auth()->attempt(['email' => $request->get('email'), 'password' => $request->get('password')]);
        //返回 bool值
        if ($res) {
            return redirect('/englishvr/playrecord');
        } else {
            return redirect('/englishvr/login');
        }
    }


    /**
     * 使用 admin guard
     */
    // protected function guard()
    // {
    //     return auth()->guard('guest');
    // }

    public function showLoginForm()
    {
        return view('EnglishVR.login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/englishvr/login');
    }
}
