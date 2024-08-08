<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        // Validate the login form input
        $request->validate([
            'username' => 'required', // Ensure username is provided
            'password' => 'required', // Ensure password is provided
        ]);

        // Retrieve only the username and password from the request
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt($credentials)) {
            // Get the currently authenticated user
            $user = Auth::user();

            // Check the user's role and redirect to the appropriate page
            if ($user->role === 'admin') {
                return view('admin.welcome'); // Redirect to admin welcome page
            } else {
                return redirect()->intended('user-dashboard'); // Redirect to user dashboard
            }
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.', // Error message for invalid credentials
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Log out the current user
        Auth::logout();

        // Redirect to the home page
        return redirect('/');
    }
}
