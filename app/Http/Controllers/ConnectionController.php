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
            'email' => 'required',
            'password' => [Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(), 'required']
        ]);
        $user = User::where('email', request()->get('email'))->first();
        if ($user) {
            if (password_verify(request()->get('password'), $user->password)) {
                auth()->login($user);
                return redirect('/')->with('success', 'Login success');
            }
        }
    }

    public function register(){
        $validate = request()->validate([
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => [Password::min(8)->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(), 'required'],
            'password2' => 'required|same:password'
        ]);
        dump($validate);

        $user = [
            'email' => $validate['email'],
            'firstname' => $validate['firstname'],
            'lastname' => $validate['lastname'],
            'password' => Hash::make($validate['password']),
        ];

        User::create($user);

        return redirect('/login')->with('success', 'Register success');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logout success');
    }

    public function edituser() {
        $user = auth()->user();

        return view('edituser', compact('user'));
    }

    public function updateuser() {


        return redirect('/')->with('success', 'User updated');
    }

    public function updatepassword() {
        //a faire
    }
}
