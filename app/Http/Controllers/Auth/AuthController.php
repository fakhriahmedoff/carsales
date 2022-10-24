<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Services\Auth\AuthService;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct()
    {
    }

    public function loginPage(): Application|View|Factory
    {
        return view('auth.login');
    }

    public function login(UserLoginRequest $request): RedirectResponse
    {
        $credentials = [
            'email'    => $request['email'],
            'password' => $request['password'],
        ];

        if(Auth::attempt($credentials)) {
            return redirect()->route('admin.home');
        }

        return redirect()->back()->withErrors(['result' => "credentials doesn't match with our records"]);

    }

    public function logout(): Application|View|Factory
    {
        Auth::logout();

        return view('auth.login');
    }

}
