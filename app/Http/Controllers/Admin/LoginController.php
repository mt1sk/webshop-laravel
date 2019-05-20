<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/administrator/home';

    public function __construct()
    {
        $this->middleware('guest:administrator')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard('administrator');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('administrator');
    }
}
