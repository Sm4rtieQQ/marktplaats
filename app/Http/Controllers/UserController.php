<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function authenticate(UserRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('user.dashboard')->with('success', 'Succesvol ingelogd.');
        }

        return back()->withErrors([
            'password' => 'Email of wachtwoord onjuist.',
        ])->onlyInput('email');
    }

    public function show()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function store()
    {
        //
    }
}
