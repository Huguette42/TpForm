<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;

class ConnectionController extends Controller
{
    public function login()
    {
        request()->validate([
            'Email' => 'required',
            'Mot_de_passe' => 'required'
        ]);
        $user = User::where('email', request()->get('Email'))->first();
        if ($user) {
            if (password_verify(request()->get('Mot_de_passe'), $user->password)) {
                auth()->login($user);
                return redirect('/')->with('success', 'Login success');
            }
        }
        return redirect('/login')->with('error', 'Email ou mot de passe incorrect');
    }

    public function register(){
        $validate = request()->validate([
            'Email' => 'required',
            'Prénom' => 'required',
            'Nom' => 'required',
            'Mot_de_passe' => [Password::min(8)->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(), 'required'],
            'Mot_de_passe_confirmation' => 'required|same:Mot_de_passe'
        ]);
        $user_find = User::where('email', $validate['Email'])->first();
        if ($user_find) {
            return redirect('/register')->with('error', 'Email deja utilisée');
        }
        $user = [
            'email' => $validate['Email'],
            'firstname' => $validate['Prénom'],
            'lastname' => $validate['Nom'],
            'password' => Hash::make($validate['Mot_de_passe']),
        ];

        $new_user = User::create($user);

        Auth::login($new_user);

        event(new Registered($new_user));

        return redirect('/')->with('success', 'Register success');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logout success');
    }

    public function edituser() {
        $user = auth()->user();

        return view('auth.edituser', compact('user'));
    }

    public function updateuser() {


        return redirect('/')->with('success', 'User updated');
    }

    public function updatepassword() {
        //a faire
    }
}
