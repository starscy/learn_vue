<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        sleep(1);
        $data = $request->validate([
            'avatar' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        if($request->hasFile('avatar')) {
            $data['avatar'] = Storage::disk('public')->put('avatars' , $request->avatar);
        }

        $user = User::create($data);

        Auth::login($user);

        return redirect()->intended('dashboard')->with('greeting', 'Welcome back!');
    }

    public function login(Request $request)
    {
        sleep(1);
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($data, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return  redirect()->intended(route('home'));
    }
}
