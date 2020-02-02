<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    public function showLogin()
    {
      
      if (auth()->guard('admin')->check()) {
        return redirect()->route('admin.dashboard.index');
      }
        return view('dashboard.login');

    }

    public function login(Request $request)
    {
        
        $remember = $request->remember;
        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('admin.dashboard.index');
        }

        return back()->withErrors(['email' => __('lang.wrongData')]);

    }

    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.getLogin');

    }
}
