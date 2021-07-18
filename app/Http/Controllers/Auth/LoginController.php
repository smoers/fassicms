<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Moco\Common\Moco;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }

    /**
     * Surcharge la methode afin de pouvoir passer un paramètre avec la valeur du Cookie
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        $cookie = Moco::cookie('login_lang',false,null,'en');
        App::setLocale($cookie);
        return view('auth.login',[
            'cookie' => $cookie,
        ]);
    }

    /**
     * Permet de créer le cookie avec la langue de l'interface de Login
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setCookie(Request $request)
    {
        Moco::cookie('login_lang',false,$request->lg);
        return redirect()->route('login');
    }


}
