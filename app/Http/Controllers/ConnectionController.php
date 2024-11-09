<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ConnectionController extends Controller
{
    public function login()
    {
        request()->validate([
            'username' => 'required|min:3|max:12',
            'password' => [Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(), 'required']
        ]);
        $user = User::where('username', request()->get('username'))->first();
        if ($user) {
            if (password_verify(request()->get('password'), $user->password)) {
                auth()->login($user);
                return redirect('/')->with('success', 'Login success');
            }
        }
    }

    public function register(){
        $validate = request()->validate([
            'username' => 'required|min:3|max:12',
            'password' => [Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(), 'required'],
            'password2' => 'required|same:password'
        ]);

        $user = User::create([
            'username' => $validate['username'],
            'password' => Hash::make($validate['password']),
        ]);

        return redirect('/login')->with('success', 'Register success');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logout success');
    }
}
