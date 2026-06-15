<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function authenticate(UserRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('user.dashboard')->with('success', 'Succesvol ingelogd.');
        }

        return back()->withErrors([
            'password' => 'Email of wachtwoord onjuist.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listings.index');
    }

    public function show()
    {
        return view('user.login');
    }

    public function register()
    {
        return view('user.register');
    }

    public function dashboard()
    {
        $listings = Listing::where('user_id', Auth::user()->id)->get();

        return view('user.dashboard', compact('listings'));
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', 'Account successvol aangemaakt!');
    }
}
