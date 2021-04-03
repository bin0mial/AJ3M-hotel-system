<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected function authenticated(Request $request, $user)
    {
        if($user->hasRole('client') && $user->client->approval == false && $user->client->receptionist_id == null){
            \Auth::logout();
        }

        if($user->hasRole('client') && $user->client->receptionist_id == null){
           return redirect()->route('clientLogin')
               ->with(["error" => ["message" => "Your Account is not Accepted Yet <i class='fas fa-ban'></i>"]]);
        }

        if($user->hasRole('client')){
            return redirect()->route('welcome');
        }
        return redirect()->route('admin.dashboard');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
