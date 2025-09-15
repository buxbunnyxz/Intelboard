<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // last_login_at set via listener
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => __('messages.invalid_credentials'),
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'full_name'     => ['required','string','max:255'],
            'email'         => ['required','string','email','max:255','unique:users'],
            'phone_number'  => ['required','digits:10'],
            'password'      => ['required','string','min:8','confirmed'],
        ]);

        $user = User::create([
            'full_name'    => $request->full_name,
            'email'        => $request->email,
            'phone_number' => $request->phone_number,
            'password'     => Hash::make($request->password),
            'role'         => 'broker',
            'joined_date'  => Carbon::now(),
            'status'       => 'active',
            // (Optional) 'email_verified_at' => now(),
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $googleId = $googleUser->getId();
            $email    = $googleUser->getEmail();
            $name     = $googleUser->getName();

            // 1. Already linked Google account
            $user = User::where('google_id', $googleId)->first();
            if ($user) {
                if (is_null($user->email_verified_at)) {
                    $user->email_verified_at = now();
                    $user->save();
                }
                Auth::login($user, true); // force remember_token
                return redirect()->route('home');
            }

            // 2. Existing local account by email -> auto-link
            $emailUser = User::where('email', $email)->first();
            if ($emailUser && is_null($emailUser->google_id)) {
                $emailUser->google_id = $googleId;
                if (is_null($emailUser->email_verified_at)) {
                    $emailUser->email_verified_at = now();
                }
                $emailUser->save();
                Auth::login($emailUser, true);
                return redirect()->route('home');
            }

            // 3. Fresh Google user -> collect phone
            session([
                'google_user' => [
                    'id'    => $googleId,
                    'name'  => $name,
                    'email' => $email,
                ]
            ]);

            return redirect()->route('register.phone');

        } catch (\Throwable $e) {
            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Unable to login using Google. Please try again.']);
        }
    }
    
    public function cancelGoogleRegistration(Request $request)
    {
        if (!session()->has('google_user')) {
            return redirect()->route('register');
        }

        $googleUser = session('google_user');

        // Safety net: if a user somehow already got created prematurely (should not happen),
        // and has this google_id but no phone_number yet, treat as incomplete and remove.
        $partial = \App\Models\User::where('google_id', $googleUser['id'])->first();

        if ($partial && (empty($partial->phone_number))) {
            // Ensure it's truly incomplete (avoid deleting legitimate accounts)
            // Optional extra guard: recently created within last 10 minutes
            if ($partial->created_at && $partial->created_at->gt(now()->subMinutes(10))) {
                $partial->delete();
            }
        }

        session()->forget('google_user');

        return redirect()
            ->route('register')
            ->with('status', __('messages.register_phone_cancelled'));
    }

    public function showPhoneNumberForm()
    {
        if (!session()->has('google_user')) {
            return redirect()->route('register');
        }
        return view('auth.register-phone');
    }

    public function storePhoneNumber(Request $request)
    {
        if (!session()->has('google_user')) {
            return redirect()->route('register');
        }

        $request->validate([
            'phone_number' => ['required','digits:10'],
        ]);

        $googleUser = session('google_user');

        // Double-check existing by email
        $existing = User::where('email', $googleUser['email'])->first();
        if ($existing) {
            // If not linked, link it now
            if (is_null($existing->google_id)) {
                $existing->google_id = $googleUser['id'];
                if (is_null($existing->email_verified_at)) {
                    $existing->email_verified_at = now();
                }
                $existing->save();
                session()->forget('google_user');
                Auth::login($existing, true);
                return redirect()->route('home');
            }
            session()->forget('google_user');
            return redirect()->route('login');
        }

        $user = User::create([
            'google_id'        => $googleUser['id'],
            'full_name'        => $googleUser['name'],
            'email'            => $googleUser['email'],
            'phone_number'     => $request->phone_number,
            'password'         => Hash::make(uniqid('gpass_', true)),
            'role'             => 'broker',
            'status'           => 'active',
            'joined_date'      => Carbon::now(),
            'email_verified_at'=> now(),
        ]);

        session()->forget('google_user');

        Auth::login($user, true);

        return redirect()->route('user.settings');
    }
}