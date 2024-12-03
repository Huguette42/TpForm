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

    // Methode de connexion

    public function login()
    {

        // Validation des champs reçus

        request()->validate([

            'Email' => 'required',
            'Mot_de_passe' => 'required'

        ]);


        // Recherche de l'utilisateur

        $user = User::where('email', request()->get('Email'))->first();


        // Verification du mot de passe

        if ($user) {

            if (password_verify(request()->get('Mot_de_passe'), $user->password)) {

                // Connexion de l'utilisateur (creation automatique de la session)

                auth()->login($user);

                return redirect('/');

            }

        }

        return redirect('/login')->with('error', 'Email ou mot de passe incorrect');
    }


    // Methode d'inscription

    public function register(){

        // Validation des champs reçus

        $validate = request()->validate([

            'Email' => 'required',
            'Prénom' => 'required',
            'Nom' => 'required',

            'Mot_de_passe' => [Password::min(8)->letters()
                                ->mixedCase()
                                ->numbers()
                                ->symbols(),
                            'required'],

            'Mot_de_passe_confirmation' => 'required|same:Mot_de_passe'

        ]);

        // Verifie si l'email est deja utilisé

        $user_find = User::where('email', $validate['Email'])->first();

        if ($user_find) {

            return redirect('/register')->with('error', 'Email deja utilisée');

        }


        // Creation de l'utilisateur

        $user = [
            'email' => $validate['Email'],
            'firstname' => $validate['Prénom'],
            'lastname' => $validate['Nom'],
            'password' => Hash::make($validate['Mot_de_passe']),
        ];

        $new_user = User::create($user);


        // Connexion de l'utilisateur (creation automatique de la session) et envoi de l'email de confirmation

        Auth::login($new_user);

        event(new Registered($new_user));


        return redirect('/')->with('success', 'Register success');
    }


    // Methode de deconnexion

    public function logout()
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Logout success');
    }


    // Methode renvoyant la page d'edition de l'utilisateur avec les informations de l'utilisateur connecté

    public function edituser() {

        $user = auth()->user();

        return view('auth.edituser', compact('user'));

    }


    // Methode de mise a jour des informations de l'utilisateur

    public function updateuser() {

        // Validation des champs reçus

        $validate = request()->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email'
        ]);

        $user = auth()->user();


        // Verfifie si l'email a été changé et si oui, verifie si l'email est deja utilisé

        if ($validate['email'] != $user->email) {

            $user_find = User::where('email', $validate['email'])->first();

            if ($user_find) {

                return redirect('/editprofil')->with('error', 'Email deja utilisée');

            }

            // Permet de reinitialiser la verification de l'email (l'utilisateur devra revalider son email)

            $user->email_verified_at = null;
        }


        // Mise a jour des informations de l'utilisateur

        $user->firstname = $validate['firstname'];
        $user->lastname = $validate['lastname'];
        $user->email = $validate['email'];

        // Sauvegarde des modifications

        $user->save();


        return redirect('/')->with('success', 'User updated');
    }


    // Methode de changement de mot de passe
    public function updatepassword() {

        // Validation des champs reçus

        $validate = request()->validate([
            'Mot_de_passe' => [Password::min(8)->letters()
            ->mixedCase()
            ->numbers()
            ->symbols(), 'required'],
            'Mot_de_passe_confirmation' => 'required|same:Mot_de_passe'
        ]);


        // Changement du mot de passe

        $user = auth()->user();

        $user->password = Hash::make($validate['Mot_de_passe']);

        $user->save();


        return redirect('/')->with('success', 'Password updated');
    }
}
