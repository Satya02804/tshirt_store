<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Constructor - Apply middleware to methods
     */
    public function __construct()
    {
        // Apply 'guest' middleware to login/register routes
        $this->middleware('guest')->only(['LoginForm', 'login', 'RegisterForm', 'register']);

        // Apply 'auth' middleware to authenticated routes
        $this->middleware('auth')->only(['destroy', 'profile', 'updateProfile']);
    }

    public function LoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

           $user = Auth::user();
            $name = $user->name;

            if ($user->can('view-dashboard')) {
                return redirect()->route('dash.home')->with('success', 'Welcome back Admin!');
            }
            $intendedUrl = session()->pull('url.intended', '/tshirt');

            return redirect($intendedUrl)->with('success', 'Welcome back ' . $name . '!');
        }

        return back()->withErrors([
            'email' => 'Invalid Credentials!',
        ]);
    }

    // User logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/tshirt');
    }

    public function RegisterForm()
    {
        return view('login.registration');
    }

    public function register(Request $request)
    {
        // Validate the data
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        // Create the User in Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign default 'user' role
        $user->assignRole('user');

        Auth::login($user);

        return redirect('/tshirt')->with('success', 'Account created successfully! Welcome, ' . $user->name);
    }

    // User forgot password
    public function forgotEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if (User::where('email', $request->email)->exists()) {

            $token = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $request->email],
                [
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]
            );

            // Send the email with the generated token
            Mail::to($request->email)->send(new ResetPasswordMail($token));

            return back()->with('success', 'Reset link has been sent to your email!');
        }

        return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
    }

    // Show the Reset Form
    public function showResetForm($token)
    {
        return view('Product.resetPassword', ['token' => $token]);
    }

    // Handle the Password Update
    public function submitResetPassword(Request $request)
    {
        // Validate Input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|confirmed',
            'token' => 'required'
        ]);

        // Check if the token exists in the password_reset_tokens table
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Invalid token or email address.']);
        }

        $tokenCreatedAt = Carbon::parse($resetRecord->created_at);

        // Check if the token is older than 1 minute
        if (Carbon::now()->gt($tokenCreatedAt->addMinutes(1))) {

            // Delete expired token to clean up
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return back()->withErrors(['email' => 'This password reset link has expired. Please request a new one.']);
        }

        // Update the User's Password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Redirect to Login
        return redirect('/tshirt')->with('success', 'Your password has been changed! Login now.');
    }

    public function profile()
    {
        return view('Profile.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        // 1. Update Name
        if ($request->has('name')) {
            $request->validate(['name' => 'required|min:3|string']);
            $user->update(['name' => $request->name]);
            return back()->with('success', 'Name updated successfully!');
        }

        // 2. Update Email
        if ($request->has('email')) {
            $request->validate([
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                    'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.com$/'
                ]
            ], [
                'email.regex' => 'Enter email address in valid format.'
            ]);
            $user->update(['email' => $request->email]);
            return back()->with('success', 'Email updated successfully!');
        }

        // 3. Update Password
        if ($request->has('current_password')) {
            $request->validate([
                'current_password' => 'required|current_password',
                'password' => 'required|min:5|confirmed',
            ]);

            $user->update(['password' => Hash::make($request->password)]);
            return back()->with('success', 'Password changed successfully!');
        }

        return back()->withErrors(['msg' => 'Nothing to update.']);
    }
}
