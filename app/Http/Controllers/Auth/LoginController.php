<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
//    protected $redirectTo = '/home';
    public function redirectPath()
    {
        if (Auth::user()->isAdmin())
        {
            return 'superadmin/home';
        }
        if (Auth::user()->isOrganizer())
        {
            return 'admin/organization/home';
        }
        if (Auth::user()->isFamilyAccountant())
        {
            return 'family/account/home';
        }
        if (Auth::user()->isIndividualAccountant())
        {
            return 'individual/home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('login')/*->route('Customer.dashboard')*/;
    }

    public function lifeBand()
    {
        return view('auth.login');
    }
}
