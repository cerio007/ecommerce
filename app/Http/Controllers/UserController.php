<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    // Show Register
    public function create() {
        return view('user.regiter');
    }
    // Create New User
    public function store(Request $request) {
        $formField = $request->validate([
            'name'=> ['required','min:3','mx:30'],
            'email'=> ['required','email',Rule::unique('users', 'email')],
            'password'=> 'required|confirmed|min:8',
        ]);

        // Hash Password
        $formField['password'] = bcrypt($formField['password']);

        // Create User
        $user = User::create($formField);

        // Login Authentication
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','You have been logged out');
    }
    // Show Login Form
    public function login(Request $request) {
        return view('users.login') ;
    }
// Authentication
    public function authenticate(Request $request) {
        $formField = $request->validate([
            'email'=> ['required','email'],
            'password'=> 'required'
        ]);
        if(auth()->attempt( $formField )) {
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now loegged in');
    }
    return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
}
}