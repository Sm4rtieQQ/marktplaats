<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Mail\EmailConfirmation;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function authenticate(UserRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('user.dashboard')->with('status', 'Succesvol ingelogd.');
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
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $listings = Listing::where('user_id', $user->id)->get();

        $bidOn = Listing::whereHas('biddings', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('user.dashboard', compact('listings', 'bidOn', 'user'));
    }

    public function toggleEmailNotifications(User $user)
    {
        $notifications = $user->notifications ? false : true;

        $user->update([
            'notifications' => $notifications,
        ]);

        return redirect()->back();
    }

    public function store(RegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('verification.notice')->with('success', 'Account successvol aangemaakt!');
    }

    public function emailnotice()
    {
        if (Auth::user()->email_verified_at) {
            return redirect()->route('user.dashboard')->with('status', 'Email adres is al bevestigd!');
        }

        return view('auth.verificationNotice');
    }

    public function emailfulfill(EmailVerificationRequest $request)
    {
        $request->fulfill();

        Mail::send(new EmailConfirmation($request->user()));

        return redirect()->route('user.dashboard')->with('status', 'Email bevestigd!');
    }

    public function emailsendlink(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Bevestigingslink verstuurd!');
    }

    public function passwordrequest()
    {
        return view('auth.forgot-password');
    }

    public function emailpassword(Request $request)
    {
        $request->validate(['email' => ' required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function passwordreset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function passwordupdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password-confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(10));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
